<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            //
            'title' => $faker->sentence(),
            'slug' => $faker->slug(),
            'content' => $faker->paragraph(),
            'thumbnail' => $faker->imageUrl(),
            'category_id' => $faker->numberBetween(1,10),
            'user_id' => $faker->numberBetween(1,1),
            'views' => $faker->numberBetween(1,1000),
            'status' => $faker->randomElement(['published','draft', 'archived', 'rejected']),
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $faker->dateTimeBetween($this->faker->dateTimeThisYear(), 'now'),
        ];
    }
}
