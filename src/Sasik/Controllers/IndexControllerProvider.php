<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:48 PM
 */

namespace Sasik\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class IndexControllerProvider extends AbstractProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', $this->getMethod('index'));

        return $controllers;
    }

    private function index(Application $app)
    {
        $sql = 'SELECT * FROM children';
        $children = $app['db']->fetchAssoc($sql);

        dump($children);

        return __CLASS__ . '::' . __METHOD__;
    }

}