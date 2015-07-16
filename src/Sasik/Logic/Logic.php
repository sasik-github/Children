<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/16/15
 * Time: 4:54 PM
 */

namespace Sasik\Logic;


/**
 *
 * Class Logic
 * Реализация логики приложения
 *
 * @package Sasik\Logic
 */
class Logic implements AbstractLogic
{
    /**
     * Авторизация родителя
     * (я присылаю с телефона номер телефона и пароль,
     * в ответ жду 200 если все хорошо,
     * и 401 если такого пользователя нет или лог/пасс неверные.
     * В обоих случаях в теле ответа жду пустой json{})
     * @param $login
     * @param $password
     * @return mixed
     */
    public function validation($login, $password)
    {
        return false;
    }

    /**
     * Добавление токена для устройства
     * (я присылаю логин, пароль, тип устройства, и токен)
     * ты смотришь, если такого ключа нет, то добавляешь данные в базу
     * @param $login
     * @param $password
     * @param $device
     * @param $token
     * @return mixed
     */
    public function addToken($login, $password, $device, $token)
    {
        return false;
    }

    /**
     * Ребенок пришел/ушел в/из школу - на вход получаешь id ребенка и тип действия
     * (0-пришел в школу, 1-ушел из школы)Находишь всех родителей ребенка,
     * и делаешь запрос к серверу GCM как написано вот тут
     * https://developers.google.com/cloud-messaging/
     * @param $childId
     * @param $eventType
     * @return mixed
     */
    public function event($childId, $eventType)
    {
        return false;
    }


}