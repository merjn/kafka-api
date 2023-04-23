<?php

declare(strict_types=1);

namespace Api\Http\Controllers\User;

use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\DoctrineDatabaseTransactionsTrait;
use Tests\TestCase;

/** @group auth-ticket */
final class AuthTicketControllerTest extends TestCase
{
    use DoctrineDatabaseTransactionsTrait;

    public function testAuthTicketCallFailsIfUnauthorized(): void
    {
        $uri = route('user.auth_ticket');

        $response = $this->json('post', $uri);
        $response->assertUnauthorized();
    }

    public function testAuthTicketCall(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        // Create a temp user - bit ugly but i'll fix factories soon
        $user = new \App\Infrastructure\Passport\User();
        $user->id = 1;

        Passport::actingAs($user);

        $uri = route('user.auth_ticket');

        $response = $this->json('post', $uri);
        $response->assertSuccessful();

        // Select the user from the database
        $user = $this->getEntityManager()->createQuery('SELECT u FROM App\Domain\Context\User\Entity\User u WHERE u.id = :id')
            ->setParameter('id', 1)
            ->getSingleResult();

        $response->assertJson(function (AssertableJson $json) use ($user): void {
            $json->where('data.auth_ticket', $user->getAuthTicket());
        });
    }
}
