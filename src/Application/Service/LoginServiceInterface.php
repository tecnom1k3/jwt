<?php
namespace Acme\Application\Service;

interface LoginServiceInterface
{
    /**
     * @return LoginService
     */
    public function getLoginService();

    /**
     * @param LoginService $loginService
     * @return void
     */
    public function setLoginService(LoginService $loginService);
}