<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 11:15 PM
 */

namespace Sasik\Models\Mapper;


class ParentsMapper extends Mapper
{
    protected $select = 'SELECT * FROM parents';

    protected $table = 'parents';

    public function findByLogin($login)
    {
        return $this->db->fetchAssoc($this->select . ' WHERE login = ?', [$login]);
    }
}