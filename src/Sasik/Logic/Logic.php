<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/16/15
 * Time: 4:54 PM
 */

namespace Sasik\Logic;

use Sasik\Google\CloudMessaging;
use Sasik\Models\Children;
use Sasik\Models\Parents;
use Sasik\Models\Tokens;


/**
 *
 * Class Logic
 * Реализация логики приложения
 *
 * @package Sasik\Logic
 */
class Logic
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
        if (Parents::validation($login, $password)) {
            return true;
        }

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
        if (!$parent = Parents::validation($login, $password)) {
            return false;
        }
        $oldToken = $parent->getToken();

//        dump($oldToken);

        $newToken = Tokens::createObj([
            'type' => $device,
            'token' => $token,
            'parent_id' => $parent->id,
        ]);

        if ($oldToken) {
            if ($oldToken->compare($newToken)) {
                return true;
            }
            $oldToken->delete();
        }

        $newToken->save();
        return true;
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
    public function event($childId, $eventType, $data)
    {
        $children = Children::find($childId);
        if (!$children) {
            return false;
        }

        $parents = $children->getParents();

        foreach ($parents as $parent) {
            /**
             * @var $parent Parents
             */
            CloudMessaging::send($parent->getToken(), $data);
        }

        return true;
    }

    /**
     *  заглушка
     * @param $login
     * @param $password
     */
    public function resetPassword($login, $password)
    {
        $parent = Parents::findByLogin($login);

        if ($parent) {
            $parent->setPassword($parent);

            // разкомменть, что бы заработало
            //$parent->save();
        }

        return true;
    }


}