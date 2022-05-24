<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
    public function show(Request $request)
    {
        $route = Route::currentRouteName();
        $userId = Auth::user()->id;
        $posts = Post::getPostDetail($userId);
        return view('detailPost', compact('route', 'posts'));
    }

    public function create(Request $request)
    {
        $route = Route::currentRouteName();
        $user_id = Auth::user()->id;
        return view('createPost', compact('route', 'user_id'));
    }

    public function edit($postId)
    {
        $route = Route::currentRouteName();
        $post_id = $postId;
        $post = Post::with("comments")->where('id', $post_id)->first();
        return view('editPost', compact('route', 'post'));
    }

    public function store(Request $request)
    {
        $save = Post::saveData($request);

        if ($save === true) {

            if (Auth::check()) {
                return redirect(route("post.detail", ["userId" => Auth::user()->id]))->with("flash_message", "Post berhasil dibuat");
            } else {
                return redirect("/")->with("flash_message", "Post berhasil dibuat");
            }
        } else {
            return redirect("/")->with("flash_message", "Post gagal dibuat");
        }
    }

    public function update(Request $request)
    {
        $update = Post::updateData($request);
        if ($update === true) {

            if (Auth::check()) {
                return redirect(route("post.detail", ["userId" => Auth::user()->id]))->with("flash_message", "Post berhasil diupdate");
            } else {
                return redirect("/")->with("flash_message", "Post berhasil diupdate");
            }
        } else {
            return redirect("/")->with("flash_message", "Post gagal dibuat");
        }
    }

    public function destroy(Request $request, $postId)
    {
        $delete = Post::destroy($postId);

        if ($delete > 0) {

            if (Auth::check()) {
                return redirect(route("post.detail", ["userId" => Auth::user()->id]))->with("flash_message", "Post berhasil dihapus");
            } else {
                return redirect("/")->with("flash_message", "Post berhasil dihapus");
            }
        } else {
            return redirect("/")->with("flash_message", "Post gagal dihapus");
        }
    }
}
