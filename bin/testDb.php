<?php
/**
 * для Создания тестовых сущносей в базе данных
 * User: sasik
 * Date: 7/17/15
 * Time: 3:05 PM
 */

define('APPLICATION_PATH', __DIR__ . '/../');
define('CONFIG', APPLICATION_PATH . '/configs/config.json');

require_once APPLICATION_PATH . "vendor/autoload.php";

use Sasik\Models\Children;
use Sasik\Models\Parents;
use Sasik\Models\Tokens;

$config = new \Noodlehaus\Config(CONFIG);

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $config->get('db'),
]);

\Sasik\Db\DbSingleton::setDb($app['db']);

$db = \Sasik\Db\DbSingleton::getDb();

/**
 * ОСТОРОЖНО
 */
foreach(['children', 'parents', 'tokens', 'children_to_parents'] as $table) {
    $query = $db->createQueryBuilder();
    $query->delete($table)->execute();
//    $db->fetchAll('DELETE FROM ' . $table );
}
//$db->delete('children', []);
//$db->delete('parents', []);
//$db->delete('tokens', []);
//$db->delete('children_to_parents', []);


$childrens = [
    Children::createObj(['name' => 'Children' . uniqid()]),
    Children::createObj(['name' => 'TestChildren']),
    Children::createObj(['name' => 'Children' . uniqid()]),
    Children::createObj(['name' => 'Children' . uniqid()]),
    Children::createObj(['name' => 'Children' . uniqid()]),
];
saveAll($childrens);

$parents = [
    Parents::createObj(['login' => 'Parent' . uniqid(), 'password' => uniqid()]),
    Parents::createObj(['login' => 'TestParent', 'password' => 'ParentPass']),
    Parents::createObj(['login' => 'Parent' . uniqid(), 'password' => uniqid()]),
    Parents::createObj(['login' => 'Parent' . uniqid(), 'password' => uniqid()]),
];
saveAll($parents);


$tokens = addTokens($parents);
saveAll($tokens);

addRelation($parents, $childrens);



function addTokens($parents)
{
    $tokens = [];
    foreach ($parents as $parent) {
        $tokens[] = Tokens::createObj([
            'parent_id' => $parent->id,
            'token' => uniqid('token-'),
            'type' => rand(0, 1),
        ]);
    }

    return $tokens;

}

function saveAll(array $collection)
{
    foreach ($collection as $el) {
        $el->save();
    }
}

function addRelation(array $parents, array $childrens)
{
    $iter = 0;
    $max = count($parents);
    foreach ($childrens as $child) {
        /**
         * @var $child Children
         */
        $child->addParent($parents[$iter]);

        $iter++;
        if ($max === $iter) {
            $iter = 0;
        }
    }


}
