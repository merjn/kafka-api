<?php

namespace App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions;

class IpCheckFailedException extends \Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
