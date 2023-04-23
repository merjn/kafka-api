<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Query\GetStaffMembers;

readonly class GetStaffMembersQuery
{
    public function __construct(
        private ?int $rank = null
    ) { }

    public function getRank(): ?int
    {
        return $this->rank;
    }
}
