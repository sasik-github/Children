<?php
/**
 * User: sasik
 * Date: 7/17/15
 * Time: 8:28 PM
 */
define('APPLICATION_PATH', __DIR__ . '/../');
define('CONFIG', APPLICATION_PATH . '/configs/config.json');

require_once APPLICATION_PATH . "vendor/autoload.php";

use \Sasik\Google\CloudMessaging;

$config = new \Noodlehaus\Config(CONFIG);

define('APP_KEY', $config->get('app_key'));


$token = 'APA91bGi5JhZbR5DebXc5HzpcCHHk4Ct_3RBhQwwpxEntOG_nIHNgHvVNUO-SelCsY5s8f638uukDCYC3bxuPeXky0WeHWB8pXUFLB2E7Q5eLEvBp4vwPTU3lEknni9M6mv4VUP1W9iY';
$resp = CloudMessaging::send($token, 'hi mother fucker');
dump($resp->getBody()->getContents());
dump($resp->getStatusCode());
dump($resp->getHeaders());

dump(\Sasik\Google\Request::send('abc', ['hi message']));

//dump($resp);