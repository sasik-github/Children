<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 10:35 PM
 */

namespace Sasik\Models\Mapper;


use Doctrine\DBAL\Connection;
use Sasik\Db\DbSingleton;

abstract class Mapper
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    protected $select = '';

    protected $table = 'children';

    protected $mapper;

    public function __construct(Connection $db)
    {
        $this->db = $db;
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

    public function delete($id){
        return $this->db->delete($this->table, ['id' => $id]);
    }


}