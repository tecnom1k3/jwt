<?php
namespace Acme\Application\Service;

use Doctrine\ORM\EntityManager;

interface EntityManagerInterface
{
    /**
     * @param EntityManager $entityManager
     * @return void
     */
    public function setEntityManager(EntityManager $entityManager);

    /**
     * @return EntityManager
     */
    public function getEntityManager();
} 