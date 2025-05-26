<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('login');
    }
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/test', function () {
    return view('auth.verify');
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Migrated";
});
Route::get('/rollback-migration', function () {
    Artisan::call('migrate:rollback --step=1');
    return "Rolled back migration";
});

Route::get('/seed', function () {
    Artisan::call('db:seed');
    return "Seeded";
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return "Cleared";
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return "Optimized";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Linked";
});