<?php
namespace Acme\Application\Service;


interface TokenServiceInterface
{
    /**
     * @param TokenService $tokenService
     * @return void
     */
    public function setTokenService(TokenService $tokenService);

    /**
     * @return TokenService
     */
    public function getTokenService();
} 