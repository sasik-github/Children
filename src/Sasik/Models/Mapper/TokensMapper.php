<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 11:17 PM
 */

namespace Sasik\Models\Mapper;


class TokensMapper extends Mapper
{
    protected $select = 'SELECT * FROM tokens';

    protected $table = 'tokens';
}