<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/people', [HomeController::class, 'search'])->name('search');
        
        // POST
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
        Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

        // COMMENT
        Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
        Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

        // PROFILE
        Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // LIKE
        Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');
        Route::delete('/like/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

        // FOLLOW
        Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
        Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
        Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
            //USER
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::delete('users/{id}/deactivate',[UsersController::class, 'deactivate'])->name('users.deactivate');
            Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');

            // POST
            Route::get('/post', [PostsController::class, 'index'])->name('posts');
            Route::delete('post/{id}/hide',[PostsController::class, 'hidden'])->name('posts.hide');
            Route::patch('/post/{id}/visible', [PostsController::class, 'visible'])->name('posts.visible');
            
            // CATEGORY
            Route::get('/category', [CategoriesController::class, 'index'])->name('categories');
            Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
            Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
            Route::patch('/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
            Route::delete('/destroy/{categories_}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

        });


});

