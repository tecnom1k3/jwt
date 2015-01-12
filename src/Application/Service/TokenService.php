<?php
namespace Acme\Application\Service;

use Acme\Application\Model\Token;
use JWT;

class TokenService
{
    const KEY = 'asdasdasdasdasdasd'; //TODO: generate/derive key for each new jwt
    
    public function generate(Token $token)
    {
        if (empty($token->iat)) {
            $token->iat = time();
        }
        
        if (empty($token->jti)) {
            $token->jti = uniqid(); //TODO: randomize
        }
        
        return JWT::encode($token->toArray(), self::KEY);
        
    }
}