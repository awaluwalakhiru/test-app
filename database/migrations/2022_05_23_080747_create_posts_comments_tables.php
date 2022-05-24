<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePostsCommentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dateTime("last_login")->nullable();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("title")->nullable();
            $table->string("slug")->nullable();
            $table->longText("content")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("set null")->onUpdate("cascade");
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();
            $table->longText("comment")->nullable();
            $table->string("type")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("set null")->onUpdate("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("set null")->onUpdate("cascade");
        });

        // User::create([
        //     "id" => 1,
        //     "name" => "admin",
        //     "email" => "admin@admin.com",
        //     "password" => "admin",
        //     "remember_token" => Str::random(16),
        //     "email_verified_at" => date("Y-m-d H:i:s"),
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("last_login");
        });
        // User::destroy(1);
        Schema::enableForeignKeyConstraints();
    }
}
