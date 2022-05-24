<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $route = Route::currentRouteName();
        $comments = Comment::getCommentGuest();
        return view('index', compact('route', 'comments'));
    }

    public function home()
    {
        $route = Route::currentRouteName();
        $posts = Post::getPostUser();
        return view('home', compact('route', 'posts'));
    }
}
