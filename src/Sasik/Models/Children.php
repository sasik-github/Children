<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/15/15
 * Time: 10:07 PM
 */

namespace Sasik\Models;


use Sasik\Models\Mapper\ChildrenMapper;
use Sasik\Models\Mapper\ParentChildrenRelation;

class Children {

    public $id;

    public $name;

    protected $parents = [];

    public static function find($id)
    {
        $mapper = new ChildrenMapper();
        $childParams = $mapper->find($id);

        $child = new Children();

        $child->id = $childParams['id'];
        $child->name = $childParams['name'];

        return $child;
    }

    public function getParents()
    {
        if (empty($this->parents)) {

            $mapper = new ParentChildrenRelation();

            $parentsArray = $mapper->findParents($this->id);

            foreach ($parentsArray as $parent) {
                $newParent = new Parents();

                $newParent->id = $parent['id'];
                $newParent->login = $parent['login'];
                $newParent->password = $parent['password'];
                $this->parents[] = $newParent;
            }
        }

        return $this->parents;
    }

    public function save()
    {
        $mapper = new ChildrenMapper();
        if ($this->id) {
            return $mapper->update($this->id, ['name' => $this->name]);
        }

        $this->id = $mapper->insert(['name' => $this->name]);

    }

}