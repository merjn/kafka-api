<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions;

class ReachedIpLimitException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
