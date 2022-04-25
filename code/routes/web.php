<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
    })->name('dashboard');
    Route::get('/persons', [\App\Http\Controllers\PersonController::class, 'index'])->name('person.index');
    Route::get('/persons/{id}', [\App\Http\Controllers\PersonController::class, 'show'])->name('person.show');
});
// Admins only
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    // Route::get('/users', UserManagement::class)->name('userManagement');
});
