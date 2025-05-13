<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    private static int $sequence = 0;
    public function definition()
    {

        $prefecture = $this->faker->prefecture();
        $city = $this->faker->city();
        $street = $this->faker->streetAddress();
        self::$sequence++;
        return [
            'name' => 'テスト'.self::$sequence,
            'email' => 'test'.self::$sequence.'@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('00000000'), // password
            'remember_token' => Str::random(10),
            'postcode' => substr_replace($this->faker->postcode(), '-', 3, 0),
            'address' => "{$prefecture}{$city}{$street}",
            'building' => $this->faker->secondaryAddress(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
