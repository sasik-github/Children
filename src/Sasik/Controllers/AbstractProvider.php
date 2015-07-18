<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 11:03 PM
 */

namespace Sasik\Controllers;


class AbstractProvider
{

    /**
     * Возвращает замыкания на метод
     * @param $name имя метода, для которого надо получить замыкание
     * @return callable
     */
    protected function getMethod($name)
    {
        $method = new \ReflectionMethod(get_class($this), $name);

        return $method->getClosure($this);
    }

}