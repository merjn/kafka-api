<?php

namespace Database\Factories;

use App\Infrastructure\Passport\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'password' => Hash::make($this->faker->password),
        ];
    }
}
