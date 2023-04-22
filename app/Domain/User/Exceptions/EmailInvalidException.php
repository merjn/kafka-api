<?php

declare(strict_types=1);

namespace App\Domain\User\Exceptions;

class EmailInvalidException extends \Exception
{
    public function __construct(string $message )
    {
        parent::__construct($message);
    }
}
