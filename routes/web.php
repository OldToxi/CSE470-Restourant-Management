<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;


Route::get('/', function () {
    return redirect()->route('admin.login');
});


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle', [MenuController::class, 'toggleAvailability'])->name('toggle');
    });


    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::get('/tables/create', [ReservationController::class, 'createTable'])->name('tables.create');
        Route::post('/tables', [ReservationController::class, 'storeTable'])->name('tables.store');
        Route::get('/tables/{id}/edit', [ReservationController::class, 'editTable'])->name('tables.edit');
        Route::put('/tables/{id}', [ReservationController::class, 'updateTable'])->name('tables.update');
        Route::delete('/tables/{id}', [ReservationController::class, 'destroyTable'])->name('tables.destroy');
        

        Route::get('/create', [ReservationController::class, 'createReservation'])->name('create');
        Route::post('/', [ReservationController::class, 'storeReservation'])->name('store');
        Route::get('/{id}/edit', [ReservationController::class, 'editReservation'])->name('edit');
        Route::put('/{id}', [ReservationController::class, 'updateReservation'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'destroyReservation'])->name('destroy');
        Route::patch('/{id}/status', [ReservationController::class, 'updateStatus'])->name('status.update');
    });
});