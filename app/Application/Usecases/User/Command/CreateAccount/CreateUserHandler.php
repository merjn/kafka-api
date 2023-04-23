<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\CreateAccount;

use App\Application\Usecases\User\Command\CreateAccount\Exceptions\CreateAccountValidationException;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Attributes\DuplicateEmailCheck;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Attributes\DuplicateUsernameCheck;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Attributes\MaxAccountCheck;
use App\Domain\Context\User\Entity\User;
use App\Domain\Context\User\Exceptions\EmailInvalidException;
use App\Domain\Context\User\Exceptions\UsernameInvalidException;
use App\Domain\Context\User\PasswordHasher\PasswordHasherInterface;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use Ecotone\Modelling\Attribute\CommandHandler;

final readonly class CreateUserHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordHasherInterface $passwordHasher
    ) { }

    #[CommandHandler]
    #[MaxAccountCheck]
    #[DuplicateUsernameCheck]
    #[DuplicateEmailCheck]
    public function handle(CreateUserCommand $command): NewUserDto
    {
        try {
            $user = new User(
                username: $command->getUsername(),
                email: $command->getEmail(),
                password: $this->passwordHasher->hash($command->getPassword()),
                motto: $command->getMotto(),
                look: $command->getLook(),
                credits: 5000, // TODO: From db
                ipAddress: $command->getIpAddress(),
                homeRoom: 0
            );

            $this->userRepository->persist($user);

            return new NewUserDto($command->getUsername());
        } catch (UsernameInvalidException|EmailInvalidException $exception) {
            throw new CreateAccountValidationException($exception->getMessage());
        }
    }
}
