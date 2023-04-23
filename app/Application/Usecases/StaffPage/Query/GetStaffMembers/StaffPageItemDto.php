<?php

declare(strict_types=1);

namespace App\Application\Usecases\StaffPage\Query\GetStaffMembers;

readonly class StaffPageItemDto
{
    public function __construct(
        private string $name,
        private array $staffMembers = []
    ) { }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<StaffMemberDto>
     */
    public function getStaffMembers(): array
    {
        return $this->staffMembers;
    }
}
