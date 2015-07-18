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
        return $this->db->fetchAssoc($this->select . ' WHERE login = ?',
            [
                $this->db->quote($login, \PDO::PARAM_STR)
            ]);
    }

    public function findAll(array $parentIDs)
    {
        $stmt = $this->db->executeQuery($this->select . ' WHERE id IN ( ? ) ',
            array($parentIDs),
            array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
        );
        return $stmt->fetchAll();
    }
}