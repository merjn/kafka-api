<?php

declare(strict_types=1);

use App\Presentation\Api\Http\Controllers\User\AuthTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->name('user.')->group(function () {
        Route::post('/auth_ticket', AuthTicketController::class)
            ->middleware(['throttle:auth.ticket'])
            ->name('auth_ticket');
    });
});

Route::prefix('/community')->name('community.')->group(function () {
    Route::get('/staff', \App\Presentation\Api\Http\Controllers\Community\StaffController::class)->name('staff');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::post('/create', \App\Presentation\Api\Http\Controllers\User\CreateUserController::class)->name('create');
});

