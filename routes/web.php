<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/services', [DashboardController::class, 'services'])->name('dashboard.services');
    Route::post('/dashboard/services', [DashboardController::class, 'serviceStore']);
    Route::delete('/dashboard/services/{service}', [DashboardController::class, 'serviceDestroy'])->name('dashboard.services.destroy');

    Route::get('/dashboard/team', [DashboardController::class, 'team'])->name('dashboard.team');
    Route::post('/dashboard/team', [DashboardController::class, 'teamStore']);
    Route::delete('/dashboard/team/{member}', [DashboardController::class, 'teamDestroy'])->name('dashboard.team.destroy');

    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [DashboardController::class, 'profileUpdate']);

    Route::get('/dashboard/reviews', [DashboardController::class, 'reviews'])->name('dashboard.reviews');
    Route::post('/dashboard/reviews', [DashboardController::class, 'reviewStore']);
    Route::delete('/dashboard/reviews/{review}', [DashboardController::class, 'reviewDestroy'])->name('dashboard.reviews.destroy');

    Route::get('/dashboard/portfolio', [DashboardController::class, 'portfolio'])->name('dashboard.portfolio');
    Route::post('/dashboard/portfolio', [DashboardController::class, 'portfolioStore']);
    Route::delete('/dashboard/portfolio/{project}', [DashboardController::class, 'portfolioDestroy'])->name('dashboard.portfolio.destroy');

    Route::get('/dashboard/events', [DashboardController::class, 'events'])->name('dashboard.events');
    Route::post('/dashboard/events', [DashboardController::class, 'eventStore']);
    Route::delete('/dashboard/events/{event}', [DashboardController::class, 'eventDestroy'])->name('dashboard.events.destroy');
    Route::post('/dashboard/events/{event}/media', [DashboardController::class, 'mediaStore'])->name('dashboard.events.media.store');
    Route::delete('/dashboard/media/{media}', [DashboardController::class, 'mediaDestroy'])->name('dashboard.media.destroy');

    Route::get('/dashboard/messages', [DashboardController::class, 'messages'])->name('dashboard.messages');
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::post('/dashboard/settings', [DashboardController::class, 'settingsUpdate'])->name('dashboard.settings.update');
});
