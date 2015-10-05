<?php
/**
 * User: sasik
 * Date: 10/5/15
 * Time: 10:55 AM
 */

namespace Sasik\Models\Mapper;


class MessagesMapper extends Mapper
{
    protected $select = 'SELECT * FROM message';
    protected $table = 'message';
}