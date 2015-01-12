<?php
namespace Acme\Application\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Acme\Application\Service\LoginService;
use Acme\Application\Service\TokenService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Acme\Application\Model\Token;

class LoginController
{
    /**
     * @var LoginService
     */
    protected $repository;

    /**
     * @var TokenService
     */
    protected $tokenService;
    
    public function __construct(LoginService $login, TokenService $tokenService) {
        $this->repository = $login;
        $this->tokenService = $tokenService;
    }

    /**
     * @param Request $request
     * @param Application $app
     */
    public function index(Request $request, Application $app) {
        $app->abort(403, "Forbidden");
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return JsonResponse
     */
    public function doLogin(Request $request, Application $app) {
        $user = $request->get('user', null);
        $password = $request->get('password', null);
        
        if (!$user || !$password) {
            $app->abort(403, 'Forbidden');
        }
        
        $userDetails = $this->repository->doLogin($user, $password);
        
        if (isset($userDetails['id']) && $userDetails['id']) {
            $token = new Token(); //TODO: dependency injection
            $token->setUserId($userDetails['id']);

            $jwt = $this->tokenService->generate($token);
            return new JsonResponse(['token' => $jwt]);
        }
        
        return new JsonResponse([], 404);
    }
}