<?php

declare(strict_types=1);

namespace App\Presentation\Api\Http\Resources\Community;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffMembersResource extends JsonResource
{
    public function toArray(Request $request)
    {
        dd($this->resource);
        return [
            'name' => $this->resource->getName(),
            'members' => collect($this->resource->getStaffMembers())
        ];
    }
}
