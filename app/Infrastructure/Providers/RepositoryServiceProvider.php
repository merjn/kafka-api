<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Context\Staff\Entity\StaffPage;
use App\Domain\Context\Staff\Repository\StaffPageRepositoryInterface;
use App\Domain\Context\User\Entity\User;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Repository\StaffPageRepository;
use App\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app): UserRepositoryInterface {
            return new UserRepository(
                $app->make(EntityManager::class),
                new ClassMetadata(User::class)
            );
        });

        $this->app->bind(StaffPageRepositoryInterface::class, function ($app): StaffPageRepositoryInterface {
            return new StaffPageRepository(
                $app->make(EntityManager::class),
                new ClassMetadata(StaffPage::class)
            );
        });
    }
}
