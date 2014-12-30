<?php
namespace Acme\Application\Model;

class Token
{
    //TODO: getters and setters
    public $userId;
    public $iat;
    public $jti;
    
    public function toArray()
    {
        return [
            'userId' => $this->userId,
            'iat'    => $this->iat,
            'jti'    => $this->jti,
            ];
    }
}