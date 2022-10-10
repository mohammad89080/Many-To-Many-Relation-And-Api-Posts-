<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile',[ProfileController::class,'index'])->name('profile');
Route::put('/profile/update',[ProfileController::class,'update'])->name('profile.update');
//

// Routes in Posts
Route::get('/posts', [PostController::class,'index'] )->name('posts');
Route::get('/posts/trashed', [PostController::class,'postsTrashed'] )->name('posts.trashed');
Route::get('/post/create', [PostController::class,'create'] )->name('post.create');
Route::post('/post/store', [PostController::class,'store'] )->name('post.store');
Route::get('/post/show/{slug}', [PostController::class,'show'] )->name('post.show');
Route::get('/post/edit/{id}', [PostController::class ,'edit'] )->name('post.edit');
Route::post('/post/update/{id}', [PostController::class ,'update'] )->name('post.update');
Route::get('/post/destroy/{id}', [PostController::class ,'destroy'] )->name('post.destroy');
Route::get('/post/hdelete/{id}', [PostController::class,'hdelete'] )->name('post.hdelete');
Route::get('/post/restore/{id}', [PostController::class ,'restore'] )->name('post.restore');
//

// Routes is Tags
Route::get('/tags', [TagController::class,'index'] )->name('tags');

Route::get('/tag/create', [TagController::class,'create'] )->name('tag.create');
Route::post('/tag/store', [TagController::class,'store'] )->name('tag.store');

Route::get('/tag/edit/{id}', [TagController::class ,'edit'] )->name('tag.edit');
Route::post('/tag/update/{id}', [TagController::class ,'update'] )->name('tag.update');
Route::get('/tag/destroy/{id}', [TagController::class ,'destroy'] )->name('tag.destroy');
//

// Routes is Users


Route::get('/users', [UserController::class,'index'] )->name('users');
Route::get('/user/create', [UserController::class,'create'] )->name('user.create');
Route::post('/user/store', [UserController::class,'store'] )->name('user.store');
Route::get('/user/destroy/{id}', [UserController::class ,'destroy'] )->name('user.destroy');
//
