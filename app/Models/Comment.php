<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getCommentGuest()
    {
        $data = Comment::with("post")->whereNull("user_id")->orderBy("comments.id", "ASC")->paginate(6);
        return $data;
    }

    public static function getCommentDetailByUserId($userId)
    {
        $data = Comment::with("post.user")->where("user_id", $userId)->orderBy("comments.id", "ASC")->paginate(6);
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
                "name" => $request->name,
                "email" => $request->email,
                "website" => $request->website,
                "comment" => $request->content,
                "user_id" => $user_id,
                "post_id" => $request->post_id,
            ];

            $save = new Comment;
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
}
