<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Providers;

use App\Domain\Context\User\PasswordHasher\PasswordHasherInterface;
use App\Domain\Context\User\Ticket\AuthTicketGeneratorInterface;
use App\Infrastructure\User\PasswordHasher\PepperedPasswordHasher;
use App\Infrastructure\User\Ticket\AuthTicketGenerator;
use Illuminate\Support\ServiceProvider;

class InfraUserProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AuthTicketGeneratorInterface::class,
            AuthTicketGenerator::class
        );

        $this->app->bind(
            PasswordHasherInterface::class,
            PepperedPasswordHasher::class,
        );
    }
}
