<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerNew;

class UserPostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");

        User::factory()->count(1)->has(
            Post::factory()
                ->count(10)
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                })
                ->has(
                    Comment::factory()
                        ->count(10)
                        ->state(function (array $attributes, Post $post) {
                            return ["post_id" => $post->id, "user_id" => 1];
                        })
                )
                ->has(
                    Comment::factory()
                        ->count(10)
                        ->state(function (array $attributes, Post $post) {
                            return ["post_id" => $post->id, "user_id" => null];
                        })
                )
        )->create();

        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
