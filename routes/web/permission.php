<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::delete('/permissions/{permission}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::put('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');