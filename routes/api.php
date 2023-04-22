<?php

declare(strict_types=1);

use App\Presentation\Http\Controllers\User\AuthTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->name('user.')->group(function () {
        Route::post('/auth_ticket', AuthTicketController::class)->name('auth_ticket');
    });
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::post('/create', \App\Presentation\Http\Controllers\User\CreateUserController::class)->name('create');
});

