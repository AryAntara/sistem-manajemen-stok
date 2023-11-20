<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "email" => fake()->unique()->safeEmail(),
            "password" => static::$password ??= Hash::make('1234567'),
            'profile_photo' => fake()->word(),
            'phone_number' => fake()->word(),
            'address' => fake()->word(),            
            'username' => fake()->word(),            
            'name' => fake()->word(),
            'id_role_staffs' => 1,
        ];
    }
}
