<?php

declare(strict_types=1);

namespace App\Presentation\Api\Http\Controllers\Community;

use App\Application\StaffPage\Query\GetStaffMembers\GetStaffMembersQuery;
use App\Presentation\Api\Http\Resources\Community\StaffMembersCollection;
use Ecotone\Modelling\QueryBus;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

final readonly class StaffController
{
    public function __construct(
        private QueryBus $queryBus
    ) { }

    /**
     * @OA\Get(
     *      path="/api/community/staff",
     *      tags={"Community"},
     *      summary="Get a list of staff members.",
     *      description="Get a list of staff members.",
     *      operationId="getStaffMembers",
     *      @OA\Parameter(
     *          name="filter[rank]",
     *          description="Filter by one or many ranks.",
     *          required=false,
     *          style="deepObject",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  type="integer",
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *     )
     * )
     */
    public function __invoke(Request $request): StaffMembersCollection
    {
        return new StaffMembersCollection(
            $this->getStaffMembers(Arr::get($request->get('filter'), 'rank', []))
        );
    }

    /**
     * Get all staff members from the query bus and transform it into a collection.
     *
     * @param array $ranks
     * @return Collection
     */
    private function getStaffMembers(array $ranks): Collection
    {
        return collect(
            $this->queryBus->send(new GetStaffMembersQuery($ranks))->getStaffPageItems()
        );
    }
}
