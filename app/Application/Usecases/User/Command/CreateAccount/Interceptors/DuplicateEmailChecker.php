<?php

namespace App\Application\Usecases\User\Command\CreateAccount\Interceptors;

use App\Application\Usecases\User\Command\CreateAccount\CreateUserCommand;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Attributes\DuplicateEmailCheck;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions\DuplicateEmailException;
use App\Application\Usecases\User\Command\CreateAccount\Specifications\GetUserByEmailSpecification;
use App\Domain\User\Repository\UserRepositoryInterface;
use Ecotone\Messaging\Attribute\Interceptor\Before;

final readonly class DuplicateEmailChecker
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    #[Before(pointcut: DuplicateEmailCheck::class)]
    public function __invoke(CreateUserCommand $command): void
    {
        $user = $this->userRepository->matchOneOrNullResult(
            new GetUserByEmailSpecification($command->getEmail())
        );

        if (null !== $user) {
            throw new DuplicateEmailException($command->getEmail());
        }
    }
}