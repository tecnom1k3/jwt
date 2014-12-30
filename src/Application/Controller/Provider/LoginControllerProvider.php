<?php
namespace Acme\Application\Controller\Provider;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Acme\Application\Service\LoginService;
use Acme\Application\Service\TokenService;
use Acme\Application\Controller\LoginController;

class LoginControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $app['login.service'] = $app->share(function() use ($app) {
            return new LoginService($app['db.connection']);
        });
        
        $app['token.service'] = $app->share(function() use ($app) {
            return new TokenService();
        });
        
        $app['login.controller'] = $app->share(function() use ($app) {
            return new LoginController($app['login.service'], $app['token.service']);
        });

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'login.controller:index');
        $controllers->post('/', 'login.controller:doLogin');

        return $controllers;
    }
}