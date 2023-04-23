<?php

declare(strict_types=1);

namespace Api\Http\Controllers\Community;

use App\Domain\Context\Staff\Entity\StaffPage;
use Tests\DoctrineDatabaseTransactionsTrait;
use Tests\TestCase;

/** @group staff-page */
final class StaffControllerTest extends TestCase
{
    use DoctrineDatabaseTransactionsTrait;

    public function testGetAllStaffMembers(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $page = new StaffPage(
            name: "Hotel Manager",
            order: 1,
            permission: $this->getEntityManager()->createQuery('SELECT p FROM App\Domain\Context\Staff\Entity\Permission p ORDER BY p.id desc')->setMaxResults(1)->getSingleResult()
        );

        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush();

        $route = route('community.staff');

        $response = $this->get($route);

        $response->assertStatus(200);
    }
}
