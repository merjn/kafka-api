<?php

declare(strict_types=1);

namespace App\Application\Usecases\StaffPage\Query\GetStaffMembers;

use App\Application\Usecases\StaffPage\Specifications\GetStaffMembersSpecification;
use App\Domain\Context\Staff\Repository\StaffPageRepositoryInterface;
use Ecotone\Modelling\Attribute\QueryHandler;

final readonly class GetStaffMembersHandler
{
    public function __construct(
        private StaffPageRepositoryInterface $staffPageRepository
    ) { }

    #[QueryHandler]
    public function handle(GetStaffMembersQuery $query): GetStaffMembersResponse
    {
        $staffPages = $this->staffPageRepository->match(new GetStaffMembersSpecification($query->getRanks()));
        dd($staffPages);


        return new GetStaffMembersResponse();
    }
}
