<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'title' => $this->faker->word(),
            'slug' => $this->faker->word() . "-" . $this->faker->slug(5, false),
            'content' => $this->faker->paragraphs(1, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
