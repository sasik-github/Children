<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 10:35 PM
 */

namespace Sasik\Models\Mapper;


use Sasik\Db\DbSingleton;

abstract class Mapper
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    protected $select = 'SELECT * FROM children';

    protected $insert = "INSERT INTO children VALUES ?";

    protected $table = 'children';

    public function __construct()
    {
        $this->db = DbSingleton::getDb();
    }

    public function select()
    {
        return $this->db->fetchAll($this->select);
    }

    public function insert(array $params)
    {
        $this->db->insert($this->table, $params);
        return $this->db->lastInsertId();
    }

    public function find($id)
    {
        return $this->db->fetchAssoc($this->select . ' WHERE id = ?', [(int) $id]);
    }

    public function update($id, array $params)
    {
        return $this->db->update($this->table, $params, ['id' => $id]);
    }


}