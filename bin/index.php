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
    'password' => 'LbyfRjpz',
    'charset' => 'utf8',
];

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $dbOptions,
]);

\Sasik\Db\DbSingleton::setDb($app['db']);


$mapper = new \Sasik\Models\Mapper\ChildrenMapper();

dump($mapper->insert(['name' => 'Ivan Kozlov']));
dump($mapper->select());
dump($mapper->find(3));

//$app->mount('/', new Sasik\Controllers\IndexControllerProvider());
//
//$app->run();