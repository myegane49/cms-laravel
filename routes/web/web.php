<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function() {
  Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
  // Route::get('/admin/posts', [PostController::class, 'index'])->name('post.index');
  // Route::get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');
  // Route::post('/admin/posts', [PostController::class, 'store'])->name('post.store');
  // Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
  // Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
  // Route::patch('/admin/posts/{post}', [PostController::class, 'update'])->name('post.update');

  // Route::get('/admin/users/{user}/profile', [UserController::class, 'show'])->name('user.show');
  // Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('user.update');
  // Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
  // Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');
});

// Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');

// Route::middleware(['role:Admin', 'auth'])->group(function() {
//   Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');
// });

// Route::middleware('can:view,user')->group(function() {
//   Route::get('/admin/users/{user}/profile', [UserController::class, 'show'])->name('user.show');
// });