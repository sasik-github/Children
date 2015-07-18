<?php
/**
 * User: sasik
 * Date: 7/18/15
 * Time: 11:27 AM
 */

define('APPLICATION_PATH', __DIR__ . '/../');
define('CONFIG', APPLICATION_PATH . '/configs/config.json');

require_once APPLICATION_PATH . "vendor/autoload.php";



$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://mobile.sonda-unic.ru/' . 'add-token',
    'http_errors' => false,
]);

$params = [
    'login' => '89131221178',
    'password' => '89131221178',
    'device' => 1,
    'token' => 'APA91bG95sMzVadM-ZOk9o8akiXPG4JthPudKI_u0EgoDjigV_cZL4iKlD5rVGaT6izsztckY4W7nTfcmZpux9vGTVNvE0fBT3_CBoGEVsgce2UfX0t21URkfZT6CYMeWKYp5t_mGMIU',
];

$resp = $client->post('', [
    'form_params' => $params
]);

dump($resp);