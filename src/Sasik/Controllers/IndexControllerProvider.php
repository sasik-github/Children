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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $controllers->post('/auth', $this->getMethod('auth'));

        return $controllers;
    }

    private function index(Application $app)
    {
        $sql = 'SELECT * FROM children';
        $children = $app['db']->fetchAssoc($sql);

        dump($children);

        return __CLASS__ . '::' . __METHOD__;
    }

    private function auth(Application $app, Request $request)
    {

        $telephone = $request->get('telephone');
        $password = $request->get('password');

        if ($telephone === '89516021698'
            && $password === 'qwerty'
            ) {

            return $app->json([], 200);
        }

        return $app->json([], 401);
    }

}