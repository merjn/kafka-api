<?php

declare(strict_types=1);

namespace App\Application\User\Command\GenerateAuthTicket;

readonly class GenerateAuthTicket
{
    public function __construct(
        private int $userId
    ) { }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
