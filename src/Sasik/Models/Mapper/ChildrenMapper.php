<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 11:14 PM
 */

namespace Sasik\Models\Mapper;


class ChildrenMapper extends Mapper
{
    protected $select = 'SELECT * FROM children';

    protected $table = 'children';
}