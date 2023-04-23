<?php

declare(strict_types=1);

namespace App\Presentation\Api\Http\Resources\Community;

use App\Application\StaffPage\Query\GetStaffMembers\StaffMemberDto;
use App\Application\StaffPage\Query\GetStaffMembers\StaffPageItemDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffMembersCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return [
            'data' => $this->collection->map(function (StaffPageItemDto $staffPageItemDto): array {
                return [
                    'name' => $staffPageItemDto->getName(),
                    'users' => collect($staffPageItemDto->getStaffMembers())->map(function (StaffMemberDto $staffMemberDto): array {
                        return [
                            'username' => $staffMemberDto->getUsername(),
                            'motto' => $staffMemberDto->getMotto(),
                            'look' => $staffMemberDto->getLook(),
                        ];
                    }),
                ];
            }),
        ];
    }
}
