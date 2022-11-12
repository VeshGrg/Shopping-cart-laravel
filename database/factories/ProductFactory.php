<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->sentence,
            'price' => $this->faker->numberBetween(50,10000),
            'user_id' => User::all()->random()->id,
            'is_featured' =>  true,
            'image' => 'https://placeimg.com/100/100/any?' . rand(1, 100)
            //'image'=>'https://source.unsplash.com/random'
        ];
    }
}
