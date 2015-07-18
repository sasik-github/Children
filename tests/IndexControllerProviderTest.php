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

        $resp = $this->makeRequest('/auth', [
            'telephone' => 'TestParent',
            'password' => 'ParentPass'
        ]);

        $this->assertEquals(200, $resp->getStatusCode());

    }

    public function testParentAuthorizationBad()
    {

        $resp = $this->makeRequest('auth',  [
                'login' => '89516021698',
                'password' => 'badPassword'
        ]);

        $this->assertEquals(401, $resp->getStatusCode());
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
        $resp = $this->makeRequest('/add-token', [
            'login' => 'TestParent',
            'password' => 'ParentPass',
            'device' => 'android',
            'token' => 'fds2314fdasfcvfdfq3214fdf',
        ]);

        $this->assertEquals(200, $resp->getStatusCode());

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
        $resp = $this->makeRequest('/add-event', [
            'login' => 'TestParent',
            'password' => 'ParentPass',
            'device' => 'android',
            'token' => 'fds2314fdasfcvfdfq3214fdf',
        ]);

        $this->assertEquals(200, $resp->getStatusCode());
    }

    private function makeRequest($path, array $params)
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->url,
            'http_errors' => false,
        ]);

        return $client->post($path, [
            'form_params' => $params
        ]);
    }

}
