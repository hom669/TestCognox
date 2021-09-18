<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'identification' => $this->faker->unique()->randomElement($array = array (1094899621, 1094899622, 1094899623, 1094899624,1094899625)),
            'email_verified_at' => now(),
            'password' => Hash::make('2021'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
