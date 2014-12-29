<?php
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use Silex\Application;
use Acme\Application\Controller\Provider\LoginControllerProvider;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();
$app['debug'] = true;
$app->register(new ServiceControllerServiceProvider());

$app->get('/', 'Acme\Application\Controller\IndexController::index');

$app->mount('/login', new LoginControllerProvider());

$app->run();