<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Context\User\Entity\User;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use App\Infrastructure\User\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app): UserRepository {
            return new UserRepository(
                $app->make(EntityManager::class),
                new ClassMetadata(User::class)
            );
        });
    }
}
