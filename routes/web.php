<?php

use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\RapportsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

   // Route::get('/users', [UserController::class, 'listusers'])->name('users.list');

    Route::middleware('role:admin')->prefix('rapports')->name('rapports.')->group(function () {
        Route::get('/', [RapportsController::class, 'index'])->name('index');
        Route::get('/creer', [RapportsController::class, 'create'])->name('create');
        Route::get('/{rapport}', [RapportsController::class, 'show'])->name('show');
        Route::post('/store', [RapportsController::class, 'store'])->name('store');
    });

    Route::middleware('role:admin,patient')->prefix('patients')->name('patients.')->group(function () {
        Route::get('/', [PatientsController::class, 'index'])->name('index');
        Route::get('/dashboard', [PatientsController::class, 'index'])->name('patients');
        Route::get('/creer', [PatientsController::class, 'create'])->name('create');
        Route::post('/store', [PatientsController::class, 'store'])->name('store');
    });

    Route::middleware('role:admin,doctor')->prefix('medecins')->name('medecins.')->group(function () {
        Route::get('/', [DoctorsController::class, 'index'])->name('index');
        Route::get('/dashboard', [DoctorsController::class, 'index'])->name('doctors');
        Route::get('/creer', [DoctorsController::class, 'create'])->name('create');
        Route::post('/store', [DoctorsController::class, 'store'])->name('store');
    });
});


