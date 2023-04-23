<?php

declare(strict_types=1);

namespace App\Application\StaffPage\Query\GetStaffMembers\Mapping;

use App\Application\StaffPage\Query\GetStaffMembers\GetStaffMembersResponse;
use App\Application\StaffPage\Query\GetStaffMembers\StaffMemberDto;
use App\Application\StaffPage\Query\GetStaffMembers\StaffPageItemDto;
use App\Domain\Context\Staff\Entity\StaffPage;
use App\Domain\Context\Staff\Entity\User;

final readonly class StaffPageToGetStaffMembersResponseMapper
{
    public function map(array $staffPages): GetStaffMembersResponse
    {
        return new GetStaffMembersResponse(array_map(function (StaffPage $staffPage): StaffPageItemDto {
            return new StaffPageItemDto(
                $staffPage->getName(),
                $this->mapStaffMembers($staffPage->getStaffMembers()),
            );
        }, $staffPages));
    }

    private function mapStaffMembers(iterable $staffMembers): array
    {
        return array_map(function (User $user): StaffMemberDto {
            return new StaffMemberDto(
                $user->getUsername(),
                $user->getMotto(),
                $user->getLook(),
            );
        }, iterator_to_array($staffMembers));
    }
}
