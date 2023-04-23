<?php

namespace App\Application\Usecases\User\Specifications;

use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetUserByIdSpecification extends BaseSpecification
{
    private string $userId;

    public function __construct(int $userId, ?string $context = null)
    {
        parent::__construct($context);

        $this->userId = $userId;
    }

    protected function getSpec()
    {
        return Spec::eq('id', $this->userId);
    }
}
