<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('profile', function () {
        return view('profile/profile');
    })->name('profile');

    Route::get('user-create', function () {
        return view('users/createuser');
    })->name('user-create');

    Route::get('user-management', [UserController::class, 'index'])->name('user-management');
    Route::delete('user-delete/{user}', [UserController::class, 'destroy'])->name('user-delete');
    Route::post('/register', [UserController::class, 'store']);
    Route::get('/logout', [LoginController::class, 'destroy']);
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/session', [LoginController::class, 'store']);
});
