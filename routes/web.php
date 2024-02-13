<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NYTimesAPIController;
use App\Http\Controllers\SavedArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NYTimesAPIController::class, 'index'])->name('home');
Route::get('/most-{type}', [NYTimesAPIController::class, 'most'])->where('type', 'viewed|shared|emailed')->name('most');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/save-article', [SavedArticleController::class, 'save'])->name('save-article');
    Route::get('/saved-articles', [SavedArticleController::class, 'getSavedArticles'])->name('saved-articles');
});
