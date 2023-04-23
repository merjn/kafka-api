<?php

declare(strict_types=1);

namespace App\Application\User\Command\CreateAccount\Interceptors\Exceptions;

class DuplicateUsernameException extends \Exception
{
    public function __construct(string $username)
    {
        parent::__construct("Username {$username} is already in use.");
    }
}
