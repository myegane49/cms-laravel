<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function() {
  Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
  Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['role:Admin', 'auth'])->group(function() {
  Route::get('/users', [UserController::class, 'index'])->name('user.index');
  Route::put('/users/{user}/attach', [UserController::class, 'attach'])->name('user.role.attach');
  Route::put('/users/{user}/detach', [UserController::class, 'detach'])->name('user.role.detach');
});

Route::middleware('can:view,user')->group(function() {
  Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.show');
});