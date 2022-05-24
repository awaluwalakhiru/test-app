<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => ['auth'], 'prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'post'], function () {
    Route::get('', [PostController::class, 'show'])->name('post.detail');
    Route::get('create', [PostController::class, 'create'])->name('post.create');
    Route::post('add', [PostController::class, 'store'])->name('post.store');
    Route::post('update', [PostController::class, 'update'])->name('post.update');
    Route::get('edit/{postId}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('delete/{postId}', [PostController::class, 'destroy'])->name('post.delete');
});


Route::group(['prefix' => 'comment'], function () {
    Route::get('{userId}', [CommentController::class, 'show'])->name('comment.detail');
    Route::get('{postId}/{userId}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('add', [CommentController::class, 'store'])->name('comment.store');
});
