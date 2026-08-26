<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchController::class, 'index']);

Route::get('/posts/create', [SearchController::class, 'create']);
Route::post('/posts/store', [SearchController::class, 'store'])->name('posts.store');

Route::get('/post/{id}', [SearchController::class, 'show'])->name('posts.show');

Route::delete('/post/delete/{id}', [SearchController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/edit/{id}', [SearchController::class, 'edit'])->name('posts.edit');
Route::put('/posts/update/{id}', [SearchController::class, 'update'])->name('posts.update');

Route::get('/posts/export', [SearchController::class, 'export'])
    ->name('posts.export');

Route::prefix('api')->group(function () {
    Route::get('/search', [SearchController::class, 'liveSearch'])->name('api.search');
});
