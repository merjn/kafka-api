<?php

declare(strict_types=1);

namespace App\Application\Usecases\User\Command\GenerateAuthTicket;

use App\Application\Exceptions\User\UserNotFoundException;
use App\Application\Usecases\User\Specifications\GetUserByIdSpecification;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use App\Domain\Context\User\Ticket\AuthTicketGeneratorInterface;
use Ecotone\Modelling\Attribute\CommandHandler;

final readonly class GenerateAuthTicketHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private AuthTicketGeneratorInterface $authTicketGenerator
    ) { }

    /**
     * @throws UserNotFoundException
     */
    #[CommandHandler]
    public function handle(GenerateAuthTicket $command): AuthTicketDto
    {
        $user = $this->userRepository->matchOneOrNullResult(
            new GetUserByIdSpecification($command->getUserId())
        );

        if (null === $user) {
            throw new UserNotFoundException($command->getUserId());
        }

        $user->setAuthTicket($this->authTicketGenerator->generatePseudorandomAuthTicket());

        return tap(new AuthTicketDto($user->getAuthTicket()), fn () => $this->userRepository->persist($user));
    }
}
