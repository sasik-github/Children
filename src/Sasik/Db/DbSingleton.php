<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 10:44 PM
 */

namespace Sasik\Db;


use Doctrine\DBAL\Connection;
use Sasik\Models\Mapper\ChildrenMapper;
use Sasik\Models\Mapper\ParentChildrenRelation;
use Sasik\Models\Mapper\ParentsMapper;
use Sasik\Models\Mapper\TokensMapper;

/**
 * Class DbSingleton
 * класс БОХ
 * все взаимодействие с БД происходит через него
 * а именно, здесь хранятся инстансы мапперов для Моделей
 * @package Sasik\Db
 */
class DbSingleton
{
    private static $db;

    private static $childrenMapper;
    private static $parentsMapper;
    private static $tokensMapper;
    private static $parentChildrenMapper;

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

    /**
     * @return ChildrenMapper
     */
    public static function getChildrenMapper()
    {
        if (!self::$childrenMapper) {
            self::$childrenMapper = new ChildrenMapper(self::getDb());
        }

        return self::$childrenMapper;
    }

    /**
     * @param ChildrenMapper $childrenMapper
     */
    public static function setChildrenMapper(ChildrenMapper $childrenMapper)
    {

        self::$childrenMapper = $childrenMapper;
    }

    /**
     * @return ParentsMapper
     */
    public static function getParentsMapper()
    {
        if (!self::$parentsMapper) {
            self::$parentsMapper = new ParentsMapper(self::getDb());
        }

        return self::$parentsMapper;
    }

    /**
     * @param ParentsMapper $parentsMapper
     */
    public static function setParentsMapper(ParentsMapper $parentsMapper)
    {

        self::$parentsMapper = $parentsMapper;
    }

    /**
     * @return TokensMapper
     */
    public static function getTokensMapper()
    {
        if (!self::$tokensMapper) {
            self::$tokensMapper = new TokensMapper(self::getDb());
        }

        return self::$tokensMapper;
    }

    /**
     * @param TokensMapper $tokensMapper
     */
    public static function setTokensMapper(TokensMapper $tokensMapper)
    {
        self::$tokensMapper = $tokensMapper;
    }

    /**
     * @return ParentChildrenRelation
     */
    public static function getParentChildrenMapper()
    {
        if (!self::$parentChildrenMapper) {
            self::$parentChildrenMapper = new ParentChildrenRelation(self::getDb());
        }

        return self::$parentChildrenMapper;
    }

    /**
     * @param ParentChildrenRelation $parentChildrenRelation
     */
    public static function setParentChildrenMapper(ParentChildrenRelation $parentChildrenRelation)
    {
        self::$parentChildrenMapper = $parentChildrenRelation;
    }







}