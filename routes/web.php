<?php

use Illuminate\Support\Facades\Route;
use Sso\SsoSdk\Http\Controllers\SsoController;

Route::controller(SsoController::class)->group(function () {
    Route::get('/redirect-login', 'redirectLogin')
        ->middleware(['web'])
        ->name('redirect.login');
    Route::post('/auth', 'auth')
        ->middleware(['api'])
        ->name('api.login');
});