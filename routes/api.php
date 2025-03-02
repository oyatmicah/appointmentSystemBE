<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes User
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-bookings', [BookingController::class, 'userBookings']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Authentication Route for admin
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Protected Routes Admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'index']);
    Route::get('/admin/users', [AuthController::class, 'getUsers']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    Route::post('/admin/register', [AuthController::class, 'registerAdmin']);
});
