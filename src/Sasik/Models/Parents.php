<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:09 PM
 */

namespace Sasik\Models;


use Sasik\Models\Mapper\ParentChildrenRelation;

class Parents {

    public $id;

    /**
     * phonenumber
     * @var
     */
    public $login;

    public $password;

    protected $childrens = [];

    public function getChildrens()
    {
        if (empty($this->childrens)) {

            $mapper = new ParentChildrenRelation();

            $parentsArray = $mapper->findChildrens($this->id);

            foreach ($parentsArray as $parent) {
                $newChildren = new Children();

                $newChildren->id = $parent['id'];
                $newChildren->name = $parent['name'];
                $this->childrens[] = $newChildren;
            }
        }

        return $this->childrens;
    }
}