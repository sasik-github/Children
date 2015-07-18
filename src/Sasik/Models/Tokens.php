<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:10 PM
 */

namespace Sasik\Models;


use Sasik\Db\DbSingleton;

class Tokens extends AbstractModel {

    public $id;

    public $parentId;

    public $token;

    public $type;


    public static function createObj(array $params)
    {
        $new = new Tokens();

        if (array_key_exists('id', $params)) {
            $new->id = $params['id'];
        }

        $new->parentId = $params['parent_id'];
        $new->token = $params['token'];
        $new->type = $params['type'];

        return $new;
    }

    public function save()
    {
        $mapper = DbSingleton::getTokensMapper();
        $params = [
            'parent_id' => $this->parentId,
            'token' => $this->token,
            'type' => $this->type,
        ];

        $this->doSave($mapper, $params);

    }

    public function delete()
    {
        $mapper = DbSingleton::getTokensMapper();
        return $mapper->delete($this->id);
    }

    public function compare(Tokens $token)
    {
        if ($this->token === $token->token
            && $this->type === $token->type )
        {
            return true;
        }

        return false;
    }
}