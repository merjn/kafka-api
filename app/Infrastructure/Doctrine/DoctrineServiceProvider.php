<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use Illuminate\Support\ServiceProvider;

class DoctrineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Configuration::class, function (): Configuration {
            return ORMSetup::createAttributeMetadataConfiguration(
                [__DIR__ . '/../../Domain'],
                true,
                null,
                null
            );
        });

        $this->app->bind(EntityManager::class, function (): EntityManager {
            $connection = DriverManager::getConnection([
                'dbname' => env('DB_DATABASE'),
                'user' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'driver' => 'pdo_mysql',
            ]);

            return tap(new EntityManager($connection, $this->app->make(Configuration::class)), function (EntityManager $entityManager): void {
                $entityManager->getConfiguration()->setDefaultRepositoryClassName(EntitySpecificationRepository::class);
            });
        });
    }
}
