<?php

namespace App\Application\Usecases\User\Command\CreateAccount\Specifications;

use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetUserByEmailSpecification extends BaseSpecification
{
    private string $email;

    public function __construct(string $username, ?string $context = null)
    {
        parent::__construct($context);

        $this->email = $username;
    }

    protected function getSpec()
    {
        return Spec::eq('email', $this->email);
    }
}
