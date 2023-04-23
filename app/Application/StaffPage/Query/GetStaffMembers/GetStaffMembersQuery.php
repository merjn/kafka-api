<?php

declare(strict_types=1);

namespace App\Application\StaffPage\Query\GetStaffMembers;

readonly class GetStaffMembersQuery
{
    public function __construct(
        private array $ranks
    ) { }

    public function getRanks(): array
    {
        return $this->ranks;
    }
}
