<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:09 PM
 */

namespace Sasik\Models;


use Sasik\Db\DbSingleton;
use Sasik\Models\Mapper\ParentChildrenRelation;

class Parents extends AbstractModel {

    public $id;

    /**
     * phonenumber
     * @var
     */
    public $login;

    public $password;

    private $childrens = [];

    private $token;

    public function getChildrens()
    {
        if (empty($this->childrens)) {

            $mapper = DbSingleton::getParentChildrenMapper();

            $childrensArray = $mapper->findChildrens($this->id);

            foreach ($childrensArray as $children) {

                $newChildren = Children::createObj($children);
                $this->childrens[] = $newChildren;
            }
        }

        return $this->childrens;
    }

    public static function createObj(array $params)
    {
        $new = new Parents();

        if (array_key_exists('id', $params)) {
            $new->id = $params['id'];
        }

        $new->login = $params['login'];
        $new->password = $params['password'];

        return $new;
        
    }

    /**
     * @param $login
     * @return Parents
     */
    public static function findByLogin($login)
    {
        $params = DbSingleton::getParentsMapper()->findByLogin($login);
        if ($params) {
            return self::createObj($params);
        }

        return null;

    }

    public function save()
    {
        $mapper = DbSingleton::getParentsMapper();
        $params = [
            'login' => $this->login,
            'password' => $this->password,
        ];

        $this->doSave($mapper, $params);

    }

    /**
     * @return Tokens
     */
    public function getToken()
    {
        if (!$this->token) {
            $mapper = DbSingleton::getTokensMapper();
            $this->token = Tokens::createObj($mapper->getToken($this->id));
        }

        return $this->token;
    }

    public function addChildren(Children $children)
    {
        $children->save();
        $this->childrens[] = $children;
        $mapper = DbSingleton::getParentChildrenMapper();
        $mapper->addRelation($this, $children);
    }

    /**
     * @param $login
     * @param $password
     * @return null|Parents
     */
    public static function validation($login, $password){
        $parent = Parents::findByLogin($login);
        if ($parent) {
            if (password_verify($password, $parent->password)) {
                return $parent;
            }
        }

        return null;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}