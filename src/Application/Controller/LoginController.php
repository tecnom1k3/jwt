<?php
namespace Acme\Application\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Acme\Application\Service\LoginService;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController
{
    protected $repository;
    
    public function __construct(LoginService $login) {
        $this->repository = $login;
    }
    
    public function index(Request $request, Application $app) {
        $app->abort(403, "Forbidden");
    }
    
    public function doLogin(Request $request, Application $app) {
        $user = $request->get('user', null);
        $password = $request->get('password', null);
        
        if (!$user || !$password) {
            $app->abort(403, 'Forbidden');
        }
        
        return new JsonResponse($this->repository->doLogin($user, $password));
    }
}