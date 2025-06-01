<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('registerSave', [UserController::class, 'register'])->name('registerSave');

Route::post('loginMatch', [UserController::class, 'login'])->name('loginMatch');


Route::middleware('alreadyLoggedIn')->group(function () {
    // Route::view('login', 'login')->name('login');
    Route::get('login', [UserController::class, 'loginPage'])
    ->name('login');
    Route::view('register', 'register')->name('register');
    Route::get('/', function () {
        return view('login');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboardPage'])
        ->name('dashboard');
    Route::resource('customers', CustomerController::class);
});

Route::get('logout', [UserController::class, 'logout'])->name('logout');



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
