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

    private $tokens = [];

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
    public function getTokens()
    {
        if (empty($this->tokens)) {
            $mapper = DbSingleton::getTokensMapper();
            $tokenSet = $mapper->getTokens($this->id);

            if (!$tokenSet) {
                return [];
            }

            foreach ($tokenSet as $tokenRow) {
                $this->tokens[] = Tokens::createObj($tokenRow);
            }
        }

        return $this->tokens;
    }

    /**
     * @param $token
     * @return null|Tokens
     */
    public function getToken($token)
    {
        $tokens = $this->getTokens();

        foreach ($tokens as $tkn) {
            /**
             * @var $tkn Tokens
             */

            if ($tkn->token == $token) {
                return $tkn;
            }
        }

        return null;
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
            if ($password === $parent->password) {
                return $parent;
            }
        }

        return null;
    }

    public function setPassword($password)
    {
//        $this->password = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $password;
    }
}