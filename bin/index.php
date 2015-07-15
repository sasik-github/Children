<?php

define('APPLICATION_PATH', __DIR__ . '/../');

require_once APPLICATION_PATH . "vendor/autoload.php";

$app = new Silex\Application();
$app['debug'] = true;

$dbOptions = [
    'driver' => 'pdo_mysql',
    'dbname' => 'mobile',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $dbOptions,
]);

$app->mount('/', new Sasik\Controllers\IndexControllerProvider());

$app->run();