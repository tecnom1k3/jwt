<?php
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use Silex\Application;
use Acme\Application\Controller\Provider\LoginControllerProvider;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();
$app['debug'] = true;

/**
 * TODO: bootstrap database connection, parameters should be from config file or 
 *       use http://xordataexchange.github.io/crypt/
 * 
 * @see http://es.slideshare.net/hhamon/silex-meets-soap-rest slide 37
 * @see http://symfony.com/doc/current/components/config/resources.html
 * @see http://symfony.com/doc/current/best_practices/configuration.html
 * @see http://symfony.com/doc/current/cookbook/configuration/external_parameters.html
 */
$app['db.connection'] = $app->share(function() {
    $config = new \Doctrine\DBAL\Configuration();
    $connectionParams = array(
        'dbname' => 'auth',
        'user' => 'tecnom1k3',
        'password' => '',
        'host' => '127.0.0.1',
        'driver' => 'pdo_mysql',
    );
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
});

$app->register(new ServiceControllerServiceProvider());

$app->get('/', 'Acme\Application\Controller\IndexController::index');

$app->mount('/login', new LoginControllerProvider());

$app->run();