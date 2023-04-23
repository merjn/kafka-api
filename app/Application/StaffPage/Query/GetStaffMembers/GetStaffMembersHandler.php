<?php

declare(strict_types=1);

namespace App\Application\StaffPage\Query\GetStaffMembers;

use App\Application\StaffPage\Query\GetStaffMembers\Mapping\StaffPageToGetStaffMembersResponseMapper;
use App\Application\StaffPage\Specifications\GetStaffMembersSpecification;
use App\Domain\Context\Staff\Repository\StaffPageRepositoryInterface;
use Ecotone\Modelling\Attribute\QueryHandler;

final readonly class GetStaffMembersHandler
{
    public function __construct(
        private StaffPageRepositoryInterface $staffPageRepository,
        private StaffPageToGetStaffMembersResponseMapper $staffPageToGetStaffMembersResponseMapper
    ) { }

    #[QueryHandler]
    public function handle(GetStaffMembersQuery $query): GetStaffMembersResponse
    {
        $staffPages = $this->staffPageRepository->match(new GetStaffMembersSpecification($query->getRanks()));
        if (count($staffPages) === 0) {
            return new GetStaffMembersResponse([]);
        }

        return $this->staffPageToGetStaffMembersResponseMapper->map($staffPages);
    }
}
