<?php

declare(strict_types=1);

namespace App\Application\Usecases\StaffPage\Query\GetStaffMembers;

readonly class GetStaffMembersResponse
{
    public function __construct(
        private array $staffPageItems = []
    ) { }

    public function getStaffPageItems(): array
    {
        return $this->staffPageItems;
    }
}
