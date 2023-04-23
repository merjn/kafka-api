<?php

declare(strict_types=1);

namespace App\Application\StaffPage\Query\GetStaffMembers;

readonly class StaffMemberDto
{
    public function __construct(
        string $username,
        string $motto,
        string $look
    ) { }
}
