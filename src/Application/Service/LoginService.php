<?php
namespace Acme\Application\Service;

use Doctrine\DBAL\Connection;

class LoginService
{
    protected $dbConn;
    
    public function __construct(Connection $conn)
    {
        $this->dbConn = $conn;
    }
    
    public function doLogin($username, $password)
    {
        $queryBuilder = $this->dbConn->createQueryBuilder();
        $queryBuilder->select('id', 'username', 'password')
            ->from('users')
            ->where('username = ?')
            ->setParameter(0, $username);
            
        $rs = $queryBuilder->execute()->fetch();
        
        if (count($rs)) {
            if (password_verify($password, $rs['password'])) {
                return [
                    'id'       => $rs['id'], 
                    'username' => $rs['username']
                    ];
            }
        }
        
        return [];
    }
}