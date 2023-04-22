<?php

namespace App\Application\Usecases\User\Command\CreateAccount\Specifications;

use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetUserByUsernameSpecification extends BaseSpecification
{
    private string $username;

    public function __construct(string $username, ?string $context = null)
    {
        parent::__construct($context);

        $this->username = $username;
    }

    protected function getSpec()
    {
        return Spec::eq('username', $this->username);
    }
}
