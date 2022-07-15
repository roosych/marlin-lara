<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){
    Route::redirect('/', 'users');
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('user/create', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::get('user/{user}/show', [UserController::class, 'show'])->name('user.show');

    Route::middleware(['can_edit'])->group(function (){
        Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{user}/edit', [UserController::class, 'update'])->name('user.update');

        Route::get('user/{user}/status', [UserController::class, 'status'])->name('user.status');
        Route::put('user/{user}/status', [UserController::class, 'setstatus'])->name('user.setstatus');

        Route::get('user/{user}/media', [UserController::class, 'media'])->name('user.media');
        Route::put('user/{user}/media', [UserController::class, 'setavatar'])->name('user.setavatar');

        Route::get('user/{user}/security', [UserController::class, 'security'])->name('user.security');
        Route::put('user/{user}/security', [UserController::class, 'editsecurity'])->name('user.editsecurity');

        Route::get('user/{user}', [UserController::class, 'delete'])->name('user.delete');
    });

});



Auth::routes();
