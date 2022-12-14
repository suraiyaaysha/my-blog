<?php

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

Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);

Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']); //shows create post form
Route::post('/blog/create/post',[\App\Http\Controllers\BlogPostController::class, 'store']); //saves the created post to the database
Route::get('/blog/{blogPost}/edit',[\App\Http\Controllers\BlogPostController::class, 'edit']); //shows edit post form
Route::put('/blog/{blogPost}/edit',[\App\Http\Controllers\BlogPostController::class, 'update']); //commits edited post to the databse
Route::delete('/blog/{blogPost}',[\App\Http\Controllers\BlogPostController::class, 'destroy']); //delets post from the databse
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
