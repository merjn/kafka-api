<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\Community;

use App\Application\Usecases\StaffPage\Query\GetStaffMembers\GetStaffMembersQuery;
use Ecotone\Modelling\QueryBus;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    public function __invoke(Request $request)
    {
        $ranks = Arr::get($request->get('filter'), 'rank', []);

        dd($this->queryBus->send(new GetStaffMembersQuery($ranks)));
        exit;
    }
}
