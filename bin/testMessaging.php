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

$token = 'APA91bGgAA6lIMDfReRkB1mEuCmVajg2rcMNWYndf1If3JyTObaTr-dy7rjkHlI1CJL6no_60cV5rMeuVZr_J9OVIkA6XC3kJmEvlroKgf1q2vTVszRzqhP1RlFRwdMPQBe5lDhJp-4W';
//$token = 'APA91bG95sMzVadM-ZOk9o8akiXPG4JthPudKI_u0EgoDjigV_cZL4iKlD5rVGaT6izsztckY4W7nTfcmZpux9vGTVNvE0fBT3_CBoGEVsgce2UfX0t21URkfZT6CYMeWKYp5t_mGMIU';
//$token = 'APA91bG15iDpwV60IQy7LlSCVBBL4dzeL7qeNpfdtIy_K2zfNEhqmT2bHfAJ_NA-ktE2fASzwp-m434w61V8gbzZJILyAT0RjeEkHMIiLoC719vPmCuy4zFW0yudOd7Eojz_jKTJ59ZM';
$resp = CloudMessaging::send($token, [
    'message' => 'hi mother fucker',
    'timestamp' => time(),
    'type' => rand(0, 1),
]);
dump($resp->getBody()->getContents());
dump($resp->getStatusCode());
dump($resp->getHeaders());

//dump(\Sasik\Google\Request::send('abc', ['hi message']));

//dump($resp);