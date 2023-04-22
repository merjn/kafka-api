<?php

namespace App\Presentation\Http\Resources\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiErrorResource extends JsonResource
{
    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode(400);

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
