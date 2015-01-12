<?php
namespace Acme\Application\Service;

use Acme\Application\Model\User;
use Doctrine\ORM\EntityManager;

class LoginService implements EntityManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    /**
     * @param $username
     * @param $password
     * @return User|null
     */
    public function doLogin($username, $password)
    {
        /*
         * Also consider implementing oauth2
         * https://bshaffer.github.io/oauth2-server-php-docs/
         * https://github.com/bshaffer/oauth2-server-php
         */

        $userRepository = $this->getEntityManager()->getRepository('Acme\Application\Model\User');

        /** @var $user User */
        $user = $userRepository->findOneBy(['username' => $username]);
        
        if ($user instanceof User) {
            if (password_verify($password, $user->getPassword())) {
                return $user;
            }
        }
        
        return null;
    }

    /**
     * @param EntityManager $entityManager
     * @return void
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}