<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', [SearchController::class, 'index']);

Route::get('/posts/create', [SearchController::class, 'create']);
Route::post('/posts/store', [SearchController::class, 'store'])->name('posts.store');

Route::get('/post/{id}', [SearchController::class, 'show'])->name('posts.show');

Route::delete('/post/delete/{id}', [SearchController::class, 'destroy'])->name('posts.destroy');