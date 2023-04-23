<?php

declare(strict_types=1);

namespace App\Application\StaffPage\Query\GetStaffMembers;

readonly class StaffMemberDto
{
    public function __construct(
        private string $username,
        private string $motto,
        private string $look
    ) { }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getMotto(): string
    {
        return $this->motto;
    }

    /**
     * @return string
     */
    public function getLook(): string
    {
        return $this->look;
    }
}
