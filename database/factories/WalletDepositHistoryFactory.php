<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalletDepositHistory>
 */
class WalletDepositHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount_before_processing' => $this->faker->randomElement(range(1, 10000)),
            'balance_modification_record' => $this->faker->randomElement(range(1, 10000)),
            'wallet_id' => $this->faker->randomElement(range(1, 10)),
            'transaction_type' => $this->faker->randomElement([0, 1]),
            'status' => $this->faker->randomElement([0,1,2]),
            'bank_code_account_number' => $this->faker->randomElement(range(1, 10000)),
            'amount' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
