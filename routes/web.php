<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BoosterpackController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainPageController::class, 'index'])->name('home');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/post/all', [PostController::class, 'allPosts'])->name('posts.all');
Route::get('/post/{id}', [PostController::class, 'getPost'])->name('posts.post');

Route::get('/boosterpack/all', [BoosterpackController::class, 'all'])->name('boosterpack.all');

Route::middleware(['auth'])->group(function () {

    Route::get('/post/like/{id}', [PostController::class, 'addLike'])->name('posts.like');

    Route::post('/boosterpack/buy', [BoosterpackController::class, 'buy'])->name('boosterpack.buy');
    Route::get('/boosterpack/info/{id}', [BoosterpackController::class, 'getInfo'])->name('boosterpack.info');

    Route::post('/comment/add', [CommentController::class, 'addComment'])->name('comments.add');
    Route::get('/comment/like/{id}', [CommentController::class, 'addLike'])->name('comments.like');

    Route::post('/profile/add_money', [ProfileController::class, 'addMoney'])->name('profile.add_money');
});
