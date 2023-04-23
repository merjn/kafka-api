<?php

declare(strict_types=1);

namespace App\Application\User\Command\GenerateAuthTicket;

readonly class AuthTicketDto
{
    public function __construct(
        private string $authTicket
    ) { }

    /**
     * @return string
     */
    public function getAuthTicket(): string
    {
        return $this->authTicket;
    }
}
