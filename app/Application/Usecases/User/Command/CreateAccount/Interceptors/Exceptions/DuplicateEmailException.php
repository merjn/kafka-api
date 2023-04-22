<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions;

class DuplicateEmailException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email {$email} is already in use.");
    }
}
