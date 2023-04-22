<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers\User;

use App\Application\Usecases\User\Command\CreateAccount\CreateUserCommand;
use App\Presentation\Http\Requests\CreateUserRequest;
use App\Presentation\Http\Resources\User\CreateUserSuccessResource;
use Ecotone\Modelling\CommandBus;

final readonly class CreateUserController
{
    public function __construct(
        private CommandBus $commandBus
    ) { }

    public function __invoke(CreateUserRequest $request): CreateUserSuccessResource
    {
        return new CreateUserSuccessResource(
            $this->commandBus->send(new CreateUserCommand(
                username: $request->get('username'),
                email: $request->get('email'),
                password: $request->get('password'),
                motto: $request->get('motto', ''),
                look: $request->get('look'),
                ipAddress: $request->ip(),
            ))
        );
    }
}
