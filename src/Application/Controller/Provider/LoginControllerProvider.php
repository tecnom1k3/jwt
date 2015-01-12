<?php
namespace Acme\Application\Controller\Provider;

use Acme\Application\Controller\LoginController;
use Acme\Application\Model\Token;
use Acme\Application\Service\LoginService;
use Acme\Application\Service\TokenService;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class LoginControllerProvider implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        $app['login.service'] = $app->share(function() use ($app) {
            return new LoginService($app['db.connection']);
        });
        
        $app['token.service'] = $app->share(function() use ($app) {
            return new TokenService();
        });

        $app['token.model'] = function() {
            return new Token();
        };
        
        $app['login.controller'] = $app->share(function() use ($app) {
            return new LoginController($app['login.service'], $app['token.service'], $app['token.model']);
        });

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'login.controller:index');
        $controllers->post('/', 'login.controller:doLogin');

        return $controllers;
    }
}