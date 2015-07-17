<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/17/15
 * Time: 9:14 AM
 */

namespace Sasik\Models;


abstract class AbstractModel
{

    protected function doSave($mapper, $params)
    {
        if ($this->id) {
            return $mapper->update($this->id, $params);
        }

        $this->id = $mapper->insert($params);
    }
}