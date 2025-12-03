<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Public Pages (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('tampilan.home');
});

Route::get('/about', function () {
    return view('tampilan.about');
});


/*
|--------------------------------------------------------------------------
| Guest Routes (Hanya untuk yang belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // LOGIN PAGE
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    // GOOGLE OAUTH
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
        ->name('google.redirect');

    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
        ->name('google.callback');

    // FACEBOOK OAUTH
    Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])
        ->name('facebook.redirect');

    Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback'])
        ->name('facebook.callback');

    // GITHUB OAUTH
    Route::get('/auth/github', [AuthController::class, 'redirectToGithub'])
        ->name('github.redirect');

    Route::get('/auth/github/callback', [AuthController::class, 'handleGithubCallback'])
        ->name('github.callback');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes (Hanya Bisa Diakses Setelah Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/profil', [ProfileController::class, 'index'])
        ->name('profil');
});
