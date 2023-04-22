<?php

namespace App\Application\Exceptions\User;

class UserNotFoundException extends \Exception
{
    public function __construct(int $userId)
    {
        parent::__construct("User with id {$userId} not found");
    }
}
