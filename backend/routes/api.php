<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', [UserController::class, 'login']);

Route::post('/user/register', [UserController::class, 'register']);

Route::post('/user/logout', [UserController::class, 'logout']);

Route::get('/employee', [EmployeeController::class, 'index']);

Route::get('/employee/download', [EmployeeController::class, 'download']);

Route::get('/employee/{id}', [EmployeeController::class, 'show']);

Route::post('/employee', [EmployeeController::class, 'store']);

Route::put('/employee/{id}', [EmployeeController::class, 'update']);

Route::post('/employee/{id}', [EmployeeController::class, 'upload']);

Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);


Route::get('/property', [PropertyController::class, 'index']);

Route::get('/property/{type}', [PropertyController::class, 'show']);

