<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest.session'])->group(function(){
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
});

Route::middleware(['auth.session'])->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/',[ProjectController::class,'index'])->name('projects.index');
    Route::get('/add',[ProjectController::class,'create'])->name('projects.create');
    Route::post('/add',[ProjectController::class,'store'])->name('projects.store');
    Route::get('/edit/{id}',[ProjectController::class,'edit'])->name('projects.edit');
    Route::put('/edit/{id}',[ProjectController::class,'update'])->name('projects.update');
    Route::delete('/delete/{id}',[ProjectController::class,'destroy'])->name('projects.destroy');
});
