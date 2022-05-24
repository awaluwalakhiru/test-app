<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => null,
            'user_id' => null,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'website' => "https://" . $this->faker->domainName(),
            'comment' => $this->faker->sentences(1, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
