<?php

declare(strict_types=1);

namespace App\Domain\Context\User\Exceptions;

class UsernameInvalidException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
