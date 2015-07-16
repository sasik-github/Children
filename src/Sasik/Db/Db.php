<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:15 PM
 */

namespace Sasik\Db;


use Sasik\Models\Children;
use Sasik\Models\Parents;
use Sasik\Models\Tokens;

class Db {

    public $childrens = [];

    public $parents = [];

    public $tokens = [];

    /**
     * Db constructor.
     * @param array $tokens
     */
    public function __construct()
    {
        $this->childrens = [
            new Children('Dina'),
            new Children('Alex'),
            new Children('Ivan')
        ];

        $this->parents = [
            new Parents($this->childrens[1]),
            new Parents($this->childrens[1]),
            new Parents($this->childrens[2]),
            new Parents($this->childrens[2]),
            new Parents($this->childrens[3]),
        ];

        $this->tokens = [
            new Tokens($this->parents[0]),
            new Tokens($this->parents[1]),
            new Tokens($this->parents[2]),
            new Tokens($this->parents[3]),
            new Tokens($this->parents[4]),
        ];

    }

    /**
     * Если пользователь существует и пароль совпадает, вернет true
     * иначе false
     * @param $login
     * @param $password
     * @return bool
     */
    public function validation($login, $password)
    {
        foreach ($this->parents as $parent) {
            /**
             * @var $parent Parent
             */
            if ($parent->login === $login) {
                return $parent === $password;
            }
        }

        return false;

    }


}