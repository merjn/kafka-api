<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\Community;

use Illuminate\Http\Request;

final readonly class StaffController
{
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
        $ranks = explode(',', $request->query('rank'));

        var_dump($ranks);
        exit;
    }
}
