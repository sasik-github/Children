<?php
/**
 * User: sasik
 * Date: 7/15/15
 * Time: 10:48 PM
 */

namespace Sasik\Controllers;


use Sasik\Logic\Logic;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexControllerProvider
 * веб часть, в которой нет ни какой логики,
 * вся логика находится Sasik\Logic\Logic
 * каждый метод дергает соответсвующий метод Logic
 *
 * @package Sasik\Controllers
 */
class IndexControllerProvider extends AbstractProvider implements ControllerProviderInterface
{

    /**
     * @var Logic
     */
    public $logic;

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
        $this->logic = new Logic();

        $controllers->get('/', $this->getMethod('index'));
        $controllers->get('/auth', $this->getMethod('auth'));
        $controllers->get('/add-token', $this->getMethod('addToken'));
        $controllers->get('/add-event', $this->getMethod('addEvent'));

        return $controllers;
    }

    private function index(Application $app)
    {

        $file = file_get_contents(APPLICATION_PATH . 'views/index.html');

        return $file;
    }

    private function auth(Application $app, Request $request)
    {

        $telephone = $request->get('login');
        $password = $request->get('password');

        if ($this->logic->validation($telephone, $password)) {
            return $app->json([], 200);
        }

        return $app->json([], 401);
    }

    private function addToken(Application $app, Request $request)
    {

        $login = $request->get('login');
        $password = $request->get('password');
        $device = $request->get('device');
        $token = $request->get('token');

        if ($this->logic->addToken($login, $password, $device, $token)) {
            return $app->json([], 200);
        }

        return $app->json([], 401);


    }

    private function addEvent(Application $app, Request $request)
    {

        $childId = $request->get('child_id');
        $eventType = $request->get('event');
        $message = $request->get('data');

        if ($this->logic->event($childId, $eventType, $message)) {
            return $app->json([], 200);
        }

        return $app->json([], 401);
    }

}
