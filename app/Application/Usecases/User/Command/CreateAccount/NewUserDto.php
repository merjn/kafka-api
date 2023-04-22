<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\CreateAccount;

readonly class NewUserDto
{
    public function __construct(
        private string $username,
    ) { }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
