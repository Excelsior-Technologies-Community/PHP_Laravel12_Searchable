<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/post/{id}', [SearchController::class, 'show'])->name('posts.show');

Route::get('/posts/create', [SearchController::class, 'create']);
Route::post('/posts/store', [SearchController::class, 'store'])->name('posts.store');
