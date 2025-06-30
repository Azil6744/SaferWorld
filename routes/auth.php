<?php

use App\Livewire\Auth\Login;
use App\Livewire\Actions\Logout;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Actions\VerifyEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\AuthApiController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::post('/logout', Logout::class)->name('logout')->middleware('auth');

Route::get('/email/verify/{id}/{hash}', VerifyEmail::class)->middleware(['signed'])->name('verification.verify');

Route::get('/reset-password', ResetPassword::class)
    ->name('password.reset')
    ->middleware('guest');
