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

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

   // Route::get('/users', [UserController::class, 'listusers'])->name('users.list');

   Route::middleware('role:admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });

    Route::middleware('role:admin')->prefix('rapports')->name('rapports.')->group(function () {
        Route::get('/', [RapportsController::class, 'index'])->name('index');
        Route::get('/creer', [RapportsController::class, 'create'])->name('create');
        Route::get('/{rapport}', [RapportsController::class, 'show'])->name('show');
        Route::post('/store', [RapportsController::class, 'store'])->name('store');
        Route::delete('/{id}', [RapportsController::class, 'delete'])->name('delete');
        Route::get('/{id}/edit', [RapportsController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::put('/{id}', [RapportsController::class, 'update'])->whereNumber('id')->name('update');
        Route::get('/{id}/download', [RapportsController::class, 'download'])->whereNumber('id')->name('download');        
        Route::get('/{id}/view', [RapportsController::class, 'show'])->whereNumber('id')->name('show');
        route::get('/{id}/sent', [RapportsController::class, 'sent'])->whereNumber('id')->name('sent');
        //send docs with smtp 
        //Route::post('/{id}/send', [RapportsController::class, 'sendEmail'])->whereNumber('id')->name('sendEmail');
    });

    Route::middleware('role:admin')->prefix('patients')->name('patients.')->group(function () {
        Route::get('/', [PatientsController::class, 'index'])->name('index');
        Route::get('/creer', [PatientsController::class, 'create'])->name('create');
        Route::post('/store', [PatientsController::class, 'store'])->name('store');
        Route::get('/{id}', [PatientsController::class, 'delete'])->whereNumber('id')->name('delete');
        Route::get('/{id}/edit', [PatientsController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::put('/{id}', [PatientsController::class, 'update'])->whereNumber('id')->name('update');
    });

    Route::middleware('role:admin')->prefix('medecins')->name('medecins.')->group(function () {
        Route::get('/', [DoctorsController::class, 'index'])->name('index');
        Route::get('/creer', [DoctorsController::class, 'create'])->name('create');
        Route::post('/store', [DoctorsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DoctorsController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::get('/{id}', [DoctorsController::class, 'delete'])->name('delete');
        Route::put('/{id}', [DoctorsController::class, 'update'])->whereNumber('id')->name('update');
    });

    Route::middleware('role:patient')->prefix('patients')->name('patients.')->group(function () {
        Route::get('/dashboard', [PatientsController::class, 'dashboard'])->name('dashboard');
        Route::get('/{id}/download', [RapportsController::class, 'download'])->whereNumber('id')->name('download');
    });

    Route::middleware('role:doctor')->prefix('medecins')->name('medecins.')->group(function () {
        Route::get('/dashboard', [DoctorsController::class, 'dashboard'])->name('dashboard');
    });

    
});

