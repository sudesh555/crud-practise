<?php

use App\Http\Controllers\Api\StudentAuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\StudentRoomController;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Students Crud
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::get('students/{id}/edit', [StudentController::class, 'edit']);
Route::put('students/{id}/edit', [StudentController::class, 'update']);
Route::delete('students/{id}/edit', [StudentController::class, 'delete']);

// Staffs Crud
Route::get('staffs', [StaffController::class, 'index']);
Route::post('staffs', [StaffController::class, 'store']);
Route::get('staffs/{id}', [StaffController::class, 'show']);
Route::get('staffs/{id}/edit', [StaffController::class, 'edit']);
Route::put('staffs/{id}/edit', [StaffController::class, 'update']);
Route::delete('staffs/{id}/edit', [StaffController::class, 'delete']);
Route::post('allocate-room', [StudentRoomController::class, 'allocate']);
Route::post('upload', [ImageUploadController::class, 'imageUpload']);


// Auth
Route::post('login', [StudentAuthController::class, 'login']);
Route::post('register', [StudentAuthController::class, 'register']);