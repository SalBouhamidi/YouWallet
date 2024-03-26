<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);


Route::post('transactions', [WalletController::class, 'sendMoney'])->middleware('auth:sanctum');
Route::get('myhistory',[WalletController::class, 'Myhistory'])->middleware('auth:sanctum');
Route::get('dashboard/admin',[WalletController::class,'allTransaction'])->middleware('auth:sanctum');
