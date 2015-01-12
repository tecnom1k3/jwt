<?php
namespace Acme\Application\Model;

//TODO: doctrinify and persist issued tokens 
class Token
{
    /**
     * User Id
     * @var int
     */
    protected $userId;

    /**
     * Issued at
     * @var int
     */
    protected $iat;

    /**
     * Json Token Id
     * @var int
     */
    protected $jti;

    /**
     * @param int $iat
     */
    public function setIat($iat)
    {
        $this->iat = $iat;
    }

    /**
     * @return int
     */
    public function getIat()
    {
        return $this->iat;
    }

    /**
     * @param int $jti
     */
    public function setJti($jti)
    {
        $this->jti = $jti;
    }

    /**
     * @return int
     */
    public function getJti()
    {
        return $this->jti;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'userId' => $this->userId,
            'iat'    => $this->iat,
            'jti'    => $this->jti,
            ];
    }
}