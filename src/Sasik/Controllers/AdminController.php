<?php
/**
 * Created by PhpStorm.
 * User: sasik
 * Date: 7/17/15
 * Time: 9:46 AM
 */

namespace Sasik\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class AdminController extends AbstractProvider implements ControllerProviderInterface
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
        $this->logic = new Logic();

        $controllers->get('/admin/', $this->getMethod('index'));


        return $controllers;
    }

    public function index()
    {

    }

}