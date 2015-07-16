<?php

/**
 * клиентский вызовы
 * User: sasik
 * Date: 7/16/15
 * Time: 10:31 AM
 */
class IndexControllerProviderTest extends PHPUnit_Framework_TestCase
{

    private $url = 'localhost:8080';
    /**
     * Авторизация родителя (я присылаю с телефона номер телефона и пароль,
     * в ответ жду 200 если все хорошо,
     * и 401 если такого пользователя нет или лог/пасс неверные.
     * В обоих случаях в теле ответа жду пустой json{})
     */
    public function testParentAuthorization()
    {

        $client = $this->makeRequest();
        $response = $client->post('/auth', [
            'form_params' => [
                'telephone' => '89516021698',
                'password' => 'qwerty'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testParentAuthorizationBad()
    {

        $client = $this->makeRequest();
        $response = $client->post('auth', [
            'form_params' => [
                'telephone' => '89516021698',
                'password' => 'badPassword'
            ]
        ]);

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * Восстановление пароля я присылаю номер телефона,
     * на сервере сделать заглушку,
     * потом сами вставят нужные данные
     */
    public function testResetPassword()
    {

    }

    /**
     * Добавление токена для устройства
     * (я присылаю логин, пароль, тип устройства, и токен)
     * ты смотришь, если такого ключа нет,
     * то добавляешь данные в базу
     */
    public function testAddToken()
    {

    }

    /**
     * Ребенок пришел/ушел в/из школу
     * на вход получаешь id ребенка и тип действия
     * (0-пришел в школу, 1-ушел из школы)
     * Находишь всех родителей ребенка,
     * и делаешь запрос к серверу GCM как написано вот тут
     * в data мне надо передать json вида
     *
        "data":{
            "message":"Петр пришел в школу",
            "timestamp":12415151615,
            "type":0
        }
     * где message это текст сообщения,
     * формируется как имя ребенка + действие
     * таймстамп - это серверное время
     * type 0-пришел, 1 - ушел
     * почитай доки, там может придти ответ что токен устройства устарел,
     * тогда надо будет удалить запись с этим токеном из таблицы
     */
    public function testChildrenEnterOrExit()
    {

    }

    private function makeRequest()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->url,
            'http_errors' => false,
        ]);

        return $client;
    }

}
