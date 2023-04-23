<?php

declare(strict_types=1);

namespace App\Presentation\Api\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="AuthTicketResource",
 *      type="object",
 *      @OA\Property(
 *          property="data",
 *          type="object",
 *          @OA\Property(
 *              property="auth_ticket",
 *              type="string",
 *              example="1234567890abcdef1234567890abcdef"
 *         )
 *      )
 * )
 */
class AuthTicketResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'auth_ticket' => $this->resource->getAuthTicket(),
        ];
    }
}
