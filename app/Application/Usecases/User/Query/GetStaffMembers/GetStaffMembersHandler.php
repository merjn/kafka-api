<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Query\GetStaffMembers;

use Ecotone\Modelling\Attribute\QueryHandler;

final readonly class GetStaffMembersHandler
{
    #[QueryHandler]
    public function handle(GetStaffMembersQuery $query): GetStaffMembersResponse
    {
        // WIP
        return new GetStaffMembersResponse();
    }
}
