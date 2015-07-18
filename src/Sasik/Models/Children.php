<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/15/15
 * Time: 10:07 PM
 */

namespace Sasik\Models;

use Sasik\Db\DbSingleton;

class Children extends AbstractModel {

    public $id;

    public $name;

    protected $parents = [];

    public static function find($id)
    {
        $childParams = DbSingleton::getChildrenMapper()->find($id);

        if ($childParams) {
            $child = self::createObj($childParams);
            return $child;
        }

        return null;



    }

    public function getParents()
    {
        if (empty($this->parents)) {

            $mapper = DbSingleton::getParentChildrenMapper();

            $parentIDs = $mapper->findParents($this->id);
            $pMapper = DbSingleton::getParentsMapper();
            $parentsArray = $pMapper->findAll(array_map(function($el){
                return $el['parent_id'];
            }, $parentIDs));


            foreach ($parentsArray as $parent) {
                $newParent = Parents::createObj($parent);
                $this->parents[] = $newParent;
            }
        }

        return $this->parents;
    }

    public function save()
    {
        $mapper = DbSingleton::getChildrenMapper();

        $params = [
            'name' => $this->name
        ];

        $this->doSave($mapper, $params);

    }

    public static function createObj(array $params)
    {
        $new = new Children();
        if (array_key_exists('id', $params)) {
            $new->id = $params['id'];
        }

        $new->name = $params['name'];

        return $new;
        
    }

    public function addParent(Parents $parent)
    {
        $parent->save();
        $this->parents[] = $parent;
        $mapper = DbSingleton::getParentChildrenMapper();
        $mapper->addRelation($parent, $this);
    }

}