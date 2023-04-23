<?php

declare(strict_types=1);

namespace App\Application\User\Command\CreateAccount;

readonly class CreateUserCommand
{
    public function __construct(
        private string $username,
        private string $email,
        private string $password,
        private string $motto,
        private string $look,
        private string $ipAddress,
    ) { }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getMotto(): string
    {
        return $this->motto;
    }

    public function getLook(): string
    {
        return $this->look;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }
}
