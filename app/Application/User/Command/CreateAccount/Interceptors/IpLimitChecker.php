<?php

declare(strict_types=1);

namespace App\Application\User\Command\CreateAccount\Interceptors;

use App\Application\User\Command\CreateAccount\CreateUserCommand;
use App\Application\User\Command\CreateAccount\Interceptors\Attributes\MaxAccountCheck;
use App\Application\User\Command\CreateAccount\Interceptors\Exceptions\IpCheckFailedException;
use App\Application\User\Command\CreateAccount\Interceptors\Exceptions\ReachedIpLimitException;
use App\Application\User\Command\CreateAccount\Specifications\GetIpCountSpecification;
use App\Domain\Context\User\Repository\UserRepositoryInterface;
use Ecotone\Messaging\Attribute\Interceptor\Before;
use Illuminate\Support\Arr;

readonly class IpLimitChecker
{
    // TODO: Use the database to check how many accounts a user can create.
    public const MAX_ACCOUNTS_PER_IP = 3;

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    /**
     * Check if the user reached the maximum number of accounts per IP address.
     *
     * @throws ReachedIpLimitException
     * @throws IpCheckFailedException
     */
    #[Before(pointcut: MaxAccountCheck::class)]
    public function __invoke(CreateUserCommand $createAccount): void
    {
        $ipCount = $this->userRepository->matchSingleResult(new GetIpCountSpecification($createAccount->getIpAddress()));
        if (null === $ipCount) {
            // The caller should definitely mark this exception as the highest severity - as it means that the database
            // is not working properly.
            throw new IpCheckFailedException();
        }

        if (Arr::first($ipCount) >= self::MAX_ACCOUNTS_PER_IP) {
            throw new ReachedIpLimitException("Your IP address has reached the maximum number of accounts");
        }
    }
}
