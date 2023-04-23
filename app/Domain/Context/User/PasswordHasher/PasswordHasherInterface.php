<?php

namespace App\Domain\Context\User\PasswordHasher;

interface PasswordHasherInterface
{
    /**
     * Hash a plaintext password.
     *
     * @param string $plaintext
     * @return string
     */
    public function hash(string $plaintext): string;

    /**
     * Verify a plaintext password against a hash.
     *
     * @param string $plaintext
     * @param string $hash
     * @return bool
     */
    public function verify(string $plaintext, string $hash): bool;
}
