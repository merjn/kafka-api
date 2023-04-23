<?php

declare(strict_types=1);

use App\Presentation\Http\Controllers\User\AuthTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->name('user.')->group(function () {
        Route::post('/auth_ticket', AuthTicketController::class)
            ->middleware(['throttle:auth.ticket'])
            ->name('auth_ticket');
    });
});

Route::prefix('/community')->name('community.')->group(function () {
    Route::get('/staff', \App\Presentation\Http\Controllers\Community\StaffController::class);
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::post('/create', \App\Presentation\Http\Controllers\User\CreateUserController::class)->name('create');
});

