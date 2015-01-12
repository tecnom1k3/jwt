<?php
namespace Acme\Application\Controller;

use Acme\Application\Model\Token;
use Acme\Application\Model\TokenInterface as TokenModelInterface;
use Acme\Application\Service\LoginService;
use Acme\Application\Service\LoginServiceInterface;
use Acme\Application\Service\TokenService;
use Acme\Application\Service\TokenServiceInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController implements LoginServiceInterface, TokenServiceInterface, TokenModelInterface
{
    /**
     * @var LoginService
     */
    protected $loginService;

    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @var Token
     */
    protected $tokenModel;
    
    public function __construct(LoginService $login, TokenService $tokenService, Token $tokenModel) {
        $this->setLoginService($login);
        $this->setTokenService($tokenService);
        $this->setToken($tokenModel);
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
        
        $userDetails = $this->getLoginService()->doLogin($user, $password);
        
        if (isset($userDetails['id']) && $userDetails['id']) {
            $token = $this->getToken();
            $token->setUserId($userDetails['id']);

            $jwt = $this->getTokenService()->generate($token);
            return new JsonResponse(['token' => $jwt]);
        }
        
        return new JsonResponse([], 404);
    }

    /**
     * @return LoginService
     */
    public function getLoginService()
    {
        return $this->loginService;
    }

    /**
     * @param LoginService $loginService
     * @return void
     */
    public function setLoginService(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @param TokenService $tokenService
     * @return void
     */
    public function setTokenService(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * @return TokenService
     */
    public function getTokenService()
    {
        return $this->tokenService;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->tokenModel;
    }

    /**
     * @param Token $token
     * @return void
     */
    public function setToken(Token $token)
    {
        $this->tokenModel = $token;
    }
}