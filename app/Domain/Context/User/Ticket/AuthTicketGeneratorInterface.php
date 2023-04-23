<?php

declare(strict_types=1);

namespace App\Domain\Context\User\Ticket;

interface AuthTicketGeneratorInterface
{
    public function generatePseudorandomAuthTicket(): string;
}
