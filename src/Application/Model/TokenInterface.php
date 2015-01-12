<?php
namespace Acme\Application\Model;


interface TokenInterface
{
    /**
     * @return Token
     */
    public function getToken();

    /**
     * @param Token $token
     * @return void
     */
    public function setToken(Token $token);
} 