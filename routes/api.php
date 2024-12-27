<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login-saksi', [AuthController::class, 'loginSaksi']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profil-saksi', [AuthController::class, 'profilSaksi']);
    Route::post('/input-suara', [AuthController::class, 'inputHasilHitung']);
    Route::get('/pengumuman', [AuthController::class, 'pengumuman']);
});
