<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\RedirectAuthMiddleware;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectAuthMiddleware::class])->group(function(){
    Route::get('/', function () {
    return view('welcome');
    })->name('home');

    Route::post('/login', [UserAuthController::class, 'login'])->name('login');
});

Route::middleware([LoginMiddleware::class])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::get('logout',[UserController::class,'logout'])->name('logout');  
    Route::get('authors/remove-book',[AuthorController::class,'remove_book'])->name('authors.remove-book');  
    Route::get('authors/remove',[AuthorController::class,'remove'])->name('authors.remove');  
    Route::resource('authors', AuthorController::class)->only([
        'index', 'show'
    ]);
    Route::resource('books', BookController::class)->only([
        'create','store'
    ]);
});

