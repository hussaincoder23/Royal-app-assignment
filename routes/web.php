<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return Http::withHeaders([
//     'Authorization' => 'Bearer dfda8263d928a9702adff42bb9cb651d0e8922c0ff2134a0ae14295319deb7c4fdb3eee6ed2e4707',
// ])->get('https://candidate-testing.com/api/v2/authors/279?orderBy=id&direction=ASC&limit=12&page=1');
return view('welcome');
})->name('home');

Route::post('/login', [UserAuthController::class, 'login'])->name('login');

Route::middleware([LoginMiddleware::class])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    
    // Route::get('authors/remove',[AuthorController::class,'remove'])->name('authors.remove');  
    // Route::get('books/create',[AuthorController::class,'remove'])->name('books.remove');  
    Route::get('authors/remove-book',[AuthorController::class,'remove_book'])->name('authors.remove-book');  
    Route::get('authors/remove',[AuthorController::class,'remove'])->name('authors.remove');  
    Route::resource('authors', AuthorController::class)->only([
        'index', 'show'
    ]);
    Route::resource('books', BookController::class)->only([
        'create','store'
    ]);
});

