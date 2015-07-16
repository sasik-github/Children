<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 10:44 PM
 */

namespace Sasik\Db;


use Doctrine\DBAL\Connection;

class DbSingleton
{
    private static $db;

    public static function setDb(Connection $db)
    {
        self::$db = $db;
    }

    /**
     * @return Connection
     */
    public static function getDb()
    {
        return self::$db;
    }



}