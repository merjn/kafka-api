<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Ticket;

use App\Domain\User\Ticket\AuthTicketGeneratorInterface;
use Illuminate\Support\Str;

final class AuthTicketGenerator implements AuthTicketGeneratorInterface
{

    public function generatePseudorandomAuthTicket(): string
    {
        return Str::random(32);
    }
}
