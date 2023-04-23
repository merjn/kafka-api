<?php

declare(strict_types=1);

namespace App\Infrastructure\User\PasswordHasher;

use App\Domain\Context\User\PasswordHasher\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class PepperedPasswordHasher hashes the password using Laravel's hashing service. It will then add a layer
 * of security by encrypting the hash using the APP_KEY. This will prevent the attacker from being able to
 * brute force the hash - as it will be encrypted with a key that is unique to the environment.
 *
 * The hash is encrypted using AES-256-GCM. The key is derived from your environment's APP_KEY. The most secure option
 * would be a secure key vault, but this is a good compromise.
 */
final readonly class PepperedPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plaintext): string
    {
        return Hash::make($plaintext);
    }

    public function verify(string $plaintext, string $hash): bool
    {
        return Hash::check($plaintext, $hash);
    }
}
