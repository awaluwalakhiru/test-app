<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function getPostDetail($id)
    {
        $data = Post::with("user", "comments")->where("user_id", $id)->paginate(6);
        return $data;
    }

    public static function getPostUser()
    {
        $data = Post::with("user", "comments")->paginate(6);
        return $data;
    }

    public static function saveData($request)
    {
        try {
            DB::statement("SET FOREIGN_KEY_CHECKS=0");
            DB::beginTransaction();

            $user_id = $request->user_id;
            if ($request->user_id == 0) {
                $user_id = null;
            }

            $data_to_save = [
                "title" => $request->title,
                "content" => $request->content,
                "user_id" => $user_id,
            ];

            $save = new Post;
            $save->fill($data_to_save);
            $save->save();

            DB::commit();
            DB::statement("SET FOREIGN_KEY_CHECKS=1");
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public static function updateData($request)
    {
        try {
            DB::statement("SET FOREIGN_KEY_CHECKS=0");
            DB::beginTransaction();

            $post_id = $request->post_id;
            $user_id = $request->user_id;
            if ($request->user_id == 0) {
                $user_id = null;
            }

            $data_to_update = [
                "title" => $request->title,
                "content" => $request->content,
                "user_id" => $user_id,
            ];

            $update = Post::find($post_id);
            $update->fill($data_to_update);
            $update->save();

            DB::commit();
            DB::statement("SET FOREIGN_KEY_CHECKS=1");
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
