<?php

namespace Tests;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\App;

trait DoctrineDatabaseTransactionsTrait
{
    private ?EntityManager $entityManager;

    public function setUpDoctrineDatabaseTransactions(): void
    {
        $this->entityManager = tap(App::make(EntityManager::class), function (EntityManager $entityManager): void {
            $entityManager->getConnection()->setAutoCommit(false);

            App::bind(EntityManager::class, fn () => $entityManager);
        });

        $this->entityManager->getConnection()->beginTransaction();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function tearDownDoctrineDatabaseTransactions(): void
    {
        $this->entityManager->getConnection()->rollback();
        $this->entityManager->getConnection()->close();
        $this->entityManager->close();

        $this->entityManager = null;
    }
}
