<?php

namespace App\Presentation\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="CreateUserSuccessResource",
 *      type="object",
 *      @OA\Property(
 *          type="object",
 *          property="data",
 *          @OA\Property(
 *              type="string",
 *              property="username",
 *          )
 *      )
 * )
 */
class CreateUserSuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'username' => $this->resource->getUsername()
        ];
    }
}
