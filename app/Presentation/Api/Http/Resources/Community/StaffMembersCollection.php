<?php

declare(strict_types=1);

namespace App\Presentation\Api\Http\Resources\Community;

use App\Application\StaffPage\Query\GetStaffMembers\StaffMemberDto;
use App\Application\StaffPage\Query\GetStaffMembers\StaffPageItemDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *     schema="StaffMembersCollection",
 *     type="object",
 *     @OA\Property(
 *          property="data",
 *          type="array",
 *          @OA\Items(
 *              type="object",
 *              @OA\Property(
 *                  property="name",
 *                  type="string",
 *                  example="Hotel Manager"
 *              ),
 *
 *              @OA\Property(
 *                  property="users",
 *                  type="array",
 *                  @OA\Items(
 *                      type="object",
 *                      @OA\Property(
 *                          property="username",
 *                          type="string",
 *                          example="Lotus"
 *                      ),
 *                      @OA\Property(
 *                          property="motto",
 *                          type="string",
 *                          example="There's no place like Habbo!"
 *                      ),
 *
 *                      @OA\Property(
 *                          property="look",
 *                          type="string",
 *                          example="hd-180-1.ch-210-66.lg-270-82.sh-290-62"
 *                      )
 *                   )
 *              )
 *          )
 *     )
 * )
 */
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
