<?php

namespace App\Application\Usecases\User\Command\CreateAccount\Specifications;

use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetIpCountSpecification extends BaseSpecification
{
    private string $ipAddress;

    public function __construct(string $ipAddress, ?string $context = null)
    {
        parent::__construct($context);

        $this->ipAddress = $ipAddress;
    }

    protected function getSpec()
    {
        return Spec::countOf(
            Spec::orX(
                Spec::eq('ipCurrent', $this->ipAddress),
                Spec::eq('ipRegister', $this->ipAddress)
            )
        );
    }
}
