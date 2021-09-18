<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'code_account' => $this->faker->unique()->regexify("/^[a-z]{10}"),
            'balance' => rand(20000,45000000),
            'enabled' => 1,
            'id_user' => rand(1,5),
        ];
    }
}
