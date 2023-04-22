<?php

declare(strict_types=1);

namespace Api\Http\Controllers\User;


use App\Application\Usecases\User\Command\CreateAccount\Interceptors\IpLimitChecker;
use App\Domain\User\Entity\User;
use App\Domain\User\PasswordHasher\PasswordHasherInterface;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\DoctrineDatabaseTransactionsTrait;
use Tests\TestCase;

final class CreateUserControllerTest extends TestCase
{
    use DoctrineDatabaseTransactionsTrait;

    public function testCreateUser(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $faker = Factory::create();

        // Sanity check - check if the account doesn't already exist
        $expectedUsername = $faker->unique()->userName;
        $expectedEmail = $faker->unique()->email;
        $expectedMotto = $faker->sentence;
        $expectedLook = "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62";

        // Get user by username
        $entity = fn () => $this->getEntityManager()->createQuery('SELECT u FROM App\Domain\User\Entity\User u WHERE u.username = :username')
            ->setParameter('username', $expectedUsername)
            ->getOneOrNullResult();

        $this->assertNull($entity());

        $uri = route('user.create', [
            'username' => $expectedUsername,
            'email' => $expectedEmail,
            'password' => 'password',
            'motto' => $expectedMotto,
            'look' => $expectedLook,
        ]);

        $this->postJson($uri)
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) use ($expectedUsername): void {
                $json->where('data.username', $expectedUsername);
            });

        $freslyCreatedUser = $entity();
        $this->assertNotNull($freslyCreatedUser, "User was not created");

        /** @var PasswordHasherInterface $passwordVerifier */
        $passwordVerifier = $this->app->make(PasswordHasherInterface::class);

        $this->assertEquals($expectedUsername, $freslyCreatedUser->getUsername(), "Username is not correct");
        $this->assertEquals($expectedEmail, $freslyCreatedUser->getEmail(), "Email is not correct");
        $this->assertEquals($expectedMotto, $freslyCreatedUser->getMotto(), "Motto is not correct");
        $this->assertEquals($expectedLook, $freslyCreatedUser->getLook(), "Look is not correct");
        $this->assertTrue($passwordVerifier->verify('password', $freslyCreatedUser->getPassword()), "Password is not correct");
    }

    /** @group exists */
    public function testCreateUserFailsIfUsernameAlreadyExists(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $faker = Factory::create();

        $username = $faker->unique()->userName;

        // Create a new random user with the email
        $user = new User(
            username: $username,
            email: $faker->unique()->email,
            password: Hash::make("password"),
            motto: $faker->sentence,
            look: "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
            credits: 0,
            ipAddress: Request::ip(),
            homeRoom: 0
        );

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        // Creating a new account using that e-mail address should fail.
        $uri = route('user.create', [
            'username' =>$username,
            'email' => $faker->unique()->email,
            'password' => 'password',
            'motto' => $faker->sentence,
            'look' => "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
        ]);

        $this->postJson($uri)->assertStatus(400);
    }

    public function testCreateUserFailsIfUsernameInvalid(): void
    {
        $invalidUsernames = [
            'aa', // too short
            Str::repeat('a', 26), // too long

            // This is not an exhaustive list of invalid usernames, but it's a good start. The pattern is just
            // a-z A-Z 0-9 and some characters such as '_', '.', and '-'. I'll create a unit test in the future
            // to ensure that the pattern is correct.
            "sdsaa b", // space
            "sdsaa\tb", // tab
            "sdsaa!b", // exclamation mark
            "sdsaa@b", // at sign
            "sdsaa#b", // hash
            "sdsa'", // single quote
            "sdsa\"", // double quote
            "sdsa£b", // pound sign
        ];

        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $faker = Factory::create();
        $route = fn (string $username) => route('user.create', [
            'username' => $username,
            'email' => $faker->unique()->email,
            'password' => 'password',
            'motto' => $faker->sentence,
            'look' => "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
        ]);

        foreach ($invalidUsernames as $invalidUsername) {
            $this->postJson($route($invalidUsername))->assertStatus(400);
        }
    }

    public function testCreateUserFailsIfEmailAlreadyExists(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $faker = Factory::create();

        $email = $faker->unique()->email;

        // Create a new random user with the email
        $user = new User(
            username: $faker->unique()->userName,
            email: $email,
            password: Hash::make("password"),
            motto: $faker->sentence,
            look: "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
            credits: 0,
            ipAddress: Request::ip(),
            homeRoom: 0
        );

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        // Creating a new account using that e-mail address should fail.
        $uri = route('user.create', [
            'username' => $faker->unique()->userName,
            'email' => $email,
            'password' => 'password',
            'motto' => $faker->sentence,
            'look' => "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
        ]);

        $this->postJson($uri)->assertStatus(400);
    }

    /** @group email */
    public function testCreateUserFailsIfEmailIsInvalid(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        $faker = Factory::create();
        $uri = route('user.create', [
            'username' => $faker->unique()->userName,
            'email' => Str::random(8),
            'password' => 'password',
            'motto' => $faker->sentence,
            'look' => "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
        ]);

        $this->postJson($uri)->assertStatus(400);
    }

    /** @group test-max-acc */
    public function testMaxAccountsPerIp(): void
    {
        $this->setUpDoctrineDatabaseTransactions();
        defer($_, fn () => $this->tearDownDoctrineDatabaseTransactions());

        // Fill the database with 5 users using the same IP address
        $this->getEntityManager()->createQuery('DELETE FROM App\Domain\User\Entity\User u WHERE u.ipCurrent = :ip OR u.ipRegister = :ip')
            ->setParameter('ip', Request::ip())
            ->execute();

        $faker = Factory::create();

        for ($i = 0; $i < IpLimitChecker::MAX_ACCOUNTS_PER_IP; $i++) {
            $user = new User(
                username: $faker->unique()->userName,
                email: $faker->unique()->email,
                password: Hash::make("password"),
                motto: $faker->sentence,
                look: "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
                credits: 0,
                ipAddress: Request::ip(),
                homeRoom: 0
            );

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        }

        $this->postJson(route('user.create'), [
            'username' => $faker->unique()->userName,
            'email' => $faker->unique()->email,
            'password' => 'password',
            'motto' => $faker->sentence,
            'look' => "hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-62",
        ])->assertStatus(400);
    }
}
