<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\User;

use App\Application\Usecases\User\Command\GenerateAuthTicket\GenerateAuthTicket;
use App\Presentation\Http\Resources\User\AuthTicketResource;
use Ecotone\Modelling\CommandBus;
use Illuminate\Contracts\Auth\Authenticatable;

final readonly class AuthTicketController
{
    public function __construct(
        private CommandBus $commandBus
    ) { }

    /**
     * @OA\Post(
     *   path="/api/user/auth_ticket",
     *   tags={"User"},
     *   summary="Generate a pseudo-random authentication ticket.",
     *
     *   security={
     *     {"password": {}}
     *   },
     *
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *
     *     @OA\JsonContent(
     *          ref="#/components/schemas/AuthTicketResource"
     *     )
     *   )
     * )
     *
     * @param Authenticatable $user
     * @return AuthTicketResource
     */
    public function __invoke(Authenticatable $user): AuthTicketResource
    {
        return new AuthTicketResource(
            $this->commandBus->send(new GenerateAuthTicket($user->getAuthIdentifier()))
        );
    }
}
