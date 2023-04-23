<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\CreateAccount\Interceptors;

use App\Application\Usecases\User\Command\CreateAccount\CreateUserCommand;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Attributes\DuplicateUsernameCheck;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions\DuplicateUsernameException;
use App\Application\Usecases\User\Command\CreateAccount\Specifications\GetUserByUsernameSpecification;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use Ecotone\Messaging\Attribute\Interceptor\Before;

final readonly class DuplicateUsernameChecker
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    #[Before(pointcut: DuplicateUsernameCheck::class)]
    public function __invoke(CreateUserCommand $command): void
    {
        $user = $this->userRepository->matchOneOrNullResult(
            new GetUserByUsernameSpecification($command->getUsername())
        );

        if (null !== $user) {
            throw new DuplicateUsernameException($command->getUsername());
        }
    }
}
