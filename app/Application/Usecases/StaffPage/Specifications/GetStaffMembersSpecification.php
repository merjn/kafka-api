<?php

declare(strict_types=1);

namespace App\Application\Usecases\StaffPage\Specifications;

use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetStaffMembersSpecification extends BaseSpecification
{
    private array $ranks;

    public function __construct(array $ranks, ?string $context = null)
    {
        parent::__construct($context);

        $this->ranks = $ranks;
    }

    protected function getSpec()
    {
        if (empty($this->ranks)) {
            return Spec::orderBy('pageOrder');
        }

        return Spec::andX(
            Spec::in('rank', $this->ranks),
            Spec::orderBy('pageOrder')
        );
    }
}
