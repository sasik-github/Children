<?php

define('APPLICATION_PATH', __DIR__ . '/../');
define('CONFIG', APPLICATION_PATH . '/configs/config.json');

require_once APPLICATION_PATH . "vendor/autoload.php";

$config = new \Noodlehaus\Config(CONFIG);

$app = new Silex\Application();
$app['debug'] = true;

$dbOptions = $config->get('db');

define('APP_KEY', $config->get('app_key'));

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $dbOptions,
]);

\Sasik\Db\DbSingleton::setDb($app['db']);


$app->mount('/', new Sasik\Controllers\IndexControllerProvider());

$app->run();
