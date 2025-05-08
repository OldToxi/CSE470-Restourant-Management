<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
route::get('/', [HomeController::class, 'my_home']);

route::get('/home',[HomeController::class,'index']);

route::get('/addfood',[AdminController::class,'addfood']);
route::post('/uploadfood',[AdminController::class,'uploadfood']);
route::get('/viewfood',[AdminController::class,'viewfood']);
route::get('/delfood/{id}',[AdminController::class,'delfood']);
route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
route::get('/my_cart',[HomeController::class,'my_cart']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
