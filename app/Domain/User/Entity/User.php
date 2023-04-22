<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\Exceptions\EmailInvalidException;
use App\Domain\User\Exceptions\UsernameInvalidException;
use Carbon\Carbon;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'users')]
class User
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[Column(type: 'string')]
    private string $username;

    #[Column(name: 'mail', type: 'string')]
    private string $email;

    #[Column(type: 'string')]
    private string $password;

    #[Column(name: 'account_created', type: 'integer')]
    private int $accountCreated;

    #[Column(name: 'last_login', type: 'integer')]
    private int $lastLogin;

    #[Column(type: 'string')]
    private string $motto;

    /**
     * TODO: Create a value object that validates the look string.
     *
     * @var string $look
     */
    #[Column(type: 'string')]
    private string $look;

    #[Column(type: 'integer')]
    private int $credits;

    #[Column(name: 'ip_register', type: 'string')]
    private string $ipRegister;

    #[Column(name: 'ip_current', type: 'string')]
    private string $ipCurrent;

    #[Column(name: 'auth_ticket', type: 'string', length: 255)]
    private string $authTicket;

    #[Column(name: 'home_room', type: 'integer')]
    private int $homeRoom;

    public function __construct(
        string $username,
        string $email,
        string $password,
        string $motto,
        string $look,
        int $credits,
        string $ipAddress,
        int $homeRoom
    ) {
        $this->setUsername($username);
        $this->setEmail($email);
        $this->password = $password;
        $this->accountCreated = Carbon::now()->getTimestamp();
        $this->motto = $motto;
        $this->look = $look;
        $this->credits = $credits;
        $this->ipRegister = $ipAddress;
        $this->ipCurrent = $ipAddress;
        $this->homeRoom = $homeRoom;

        $this->lastLogin = Carbon::now()->getTimestamp();
        $this->authTicket = "";
    }

    /**
     * @param string $username
     * @return void
     * @throws UsernameInvalidException
     */
    public function setUsername(string $username): void
    {
        if ('' === $username) {
            throw new UsernameInvalidException('Username cannot be empty');
        }

        if (strlen($username) < 3 || strlen($username) > 25) {
            throw new UsernameInvalidException('Username must be between 3 and 25 characters long');
        }

        if (!preg_match('/^[a-zA-Z0-9_.-]+$/', $username)) {
            throw new UsernameInvalidException('Username can only contain letters, numbers, underscores, dashes and dots');
        }

        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailInvalidException("The email address {$email} is invalid");
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMotto(): string
    {
        return $this->motto;
    }

    /**
     * @return string
     */
    public function getLook(): string
    {
        return $this->look;
    }

    public function setAuthTicket(string $authTicket): void
    {
        $this->authTicket = $authTicket;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAuthTicket(): string
    {
        return $this->authTicket;
    }
}
