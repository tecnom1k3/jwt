<?php
namespace Acme\Application\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    /**
     * @param Request $request
     * @param Application $app
     * @return Response
     */
    public function index(Request $request, Application $app) {
        return new Response('Hello World from: ' . __CLASS__);
    }
}