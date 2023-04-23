<?php

declare(strict_types=1);

namespace App\Application\Usecases\StaffPage\Query\GetStaffMembers;

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
