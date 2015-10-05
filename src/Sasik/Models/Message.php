<?php
/**
 * User: sasik
 * Date: 10/5/15
 * Time: 10:39 AM
 */

namespace Sasik\Models;


class Message extends AbstractModel
{
    public $id;
    public $parent_id;
    public $child_id;
    public $message;
    public $date;

    /**
     * @param array $params
     * @return Message
     */
    public static function createObj(array $params)
    {
        $message = new Message();

        if (array_key_exists('id', $params)) {
            $message->id = $params['id'];
        }

        $message->parent_id = $params['parent_id'];
        $message->child_id = $params['child_id'];
        $message->message = $params['message'];
        $message->date = $params['date'];

        return $message;
    }
}