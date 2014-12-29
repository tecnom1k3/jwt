<?php
namespace Acme\Application\Service;

class LoginService
{
    public function doLogin($username, $password)
    {
        return array($username, $password);
    }
}