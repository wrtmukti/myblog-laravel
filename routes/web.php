<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

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

//basic
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


//pake grup auth sanctum
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//     Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

//     Route::resource('/category', 'CategoryController');
//     Route::resource('/tag', 'TagsController');

//     More routes here

// });

Route::get('/', function () {
    return view('index');
});

Route::get('/home', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('users/{id}/dashboard', [ArticleController::class, 'index']);
    Route::get('users/{user_id}/article/{article}/show', [ArticleController::class, 'show']);
    Route::get('users/{id}/article/create', [ArticleController::class, 'create']);
    Route::post('users/dashboard/{id}', [ArticleController::class, 'store']);
    Route::get('users/{user_id}/article/{article}/edit', [ArticleController::class, 'edit']);
    Route::put('/users/{id}/dashboard', [ArticleController::class, 'update']);
    Route::delete('/users/{user_id}/article/{article}/delete', [ArticleController::class, 'destroy']);
    Route::put('/users/{user_id}/article/{article}/publish', [ArticleController::class, 'publish']);
    Route::put('/users/{user_id}/article/{article}/archive', [ArticleController::class, 'archive']);
    Route::post('/users/{user_id}/article/{article}/show ', [ArticleController::class, 'comment_store']);

    // Route::patch('users/dashboard/{id}', [ArticleController::class, 'public']);
});
