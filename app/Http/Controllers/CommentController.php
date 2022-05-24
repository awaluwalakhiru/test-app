<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CommentController extends Controller
{
    public function create($postId, $userId = 0)
    {
        $route = Route::currentRouteName();
        $post_id = $postId;
        $user_id = Auth::user()->id;
        return view('createComment', compact('route', 'post_id', 'user_id'));
    }

    public function store(Request $request)
    {
        $save = Comment::saveData($request);


        if ($save === true) {

            if (Auth::check()) {
                return redirect(route("comment.detail", ["userId" => Auth::user()->id]))->with("flash_message", "Comment berhasil dibuat");
            } else {
                return redirect("/")->with("flash_message", "Comment berhasil dibuat");
            }
        } else {
            return redirect("/")->with("flash_message", "Comment gagal dibuat");
        }
    }

    public function show(Request $request)
    {
        $route = Route::currentRouteName();
        $userId = Auth::user()->id;
        $comments = Comment::getCommentDetailByUserId($userId);
        return view('detailCommentUser', compact('route', 'comments'));
    }
}
