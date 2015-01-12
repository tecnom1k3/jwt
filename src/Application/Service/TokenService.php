<?php
namespace Acme\Application\Service;

use Acme\Application\Model\Token;
use JWT;

class TokenService
{
    const KEY = 'asdasdasdasdasdasd'; //TODO: generate/derive key for each new jwt

    /**
     * @param Token $token
     * @return string
     */
    public function generate(Token $token)
    {
        if (!$token->getIat()) {
            $token->setIat(time());
        }
        
        if (!$token->getJti()) {
            $token->setJti(uniqid()); //TODO: randomize
        }
        
        return JWT::encode($token->toArray(), self::KEY);
    }
}