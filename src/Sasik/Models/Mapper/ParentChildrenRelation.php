<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 11:23 PM
 */

namespace Sasik\Models\Mapper;


class ParentChildrenRelation extends Mapper
{
    protected $table = 'children_to_parents';

    public function findChildrens($parentId)
    {
        return $this->db->fetchAll('SELECT * FROM ' . $this->table . ' WHERE parent_id = ?', [(int) $parentId]);
    }

    public function findParents($childrenId)
    {
        return $this->db->fetchAll('SELECT * FROM ' . $this->table . ' WHERE children_id = ?', [(int) $childrenId]);
    }


}