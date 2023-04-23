<?php

namespace App\Presentation\Api\Http\Resources\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="ApiErrorResource",
 *      type="object",
 *      @OA\Property(
 *          type="object",
 *          property="data",
 *          @OA\Property(
 *              type="string",
 *              property="error",
 *              example="The given data was invalid."
 *          )
 *      )
 * )
 */
class ApiErrorResource extends JsonResource
{
    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode(422);

        parent::withResponse($request, $response);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'error' => $this->resource->getMessage(),
        ];
    }
}
