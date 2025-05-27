<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index'); 
    Route::post('/two-factor-verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify'); 
});

Route::middleware('auth', 'twofactor')->group(function () {
    Route::get('/dashboard', [TwoFactorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // weather
    Route::get('home', [WeatherController::class, 'home'])->name('home');
    Route::match(['post', 'get'],'weather', [WeatherController::class, 'index'])->name('weather.form');
});

require __DIR__.'/auth.php';

