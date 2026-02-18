<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/delete', [PermissionController::class, 'destroy'])->name('permission.destroy');

    //role routs

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('role.destroy');

    // article routs

    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/articles/{id}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/articles/delete', [ArticleController::class, 'destroy'])->name('article.destroy');

});

require __DIR__.'/auth.php';
