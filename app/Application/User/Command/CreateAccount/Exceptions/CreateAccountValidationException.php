<?php

declare(strict_types=1);

namespace App\Application\User\Command\CreateAccount\Exceptions;

class CreateAccountValidationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
