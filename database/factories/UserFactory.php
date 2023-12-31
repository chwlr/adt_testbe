<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        return [
            'name' => $first_name." ".$last_name,
            'email' => fake()->email(),
            'password' => \Illuminate\Support\Facades\Hash::make(fake()->password())
        ];
    }
}
