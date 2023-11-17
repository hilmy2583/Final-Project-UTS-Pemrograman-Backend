<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Untuk Register
Route::post('/register', [AuthController::class, 'register']);

// Untuk Login
Route::post('/login', [AuthController::class, 'login']);

// penggunaan auth sanctum secara grup
Route::middleware('auth:sanctum')->group(function(){
    // Menampilkan semua data
    Route::get('/employees', [EmployeesController::class, 'index']);

    // Menambahkan resource
    Route::post('/employees', [EmployeesController::class, 'store']);

    // Menampilkan resource tertentu berrdasarkan id
    Route::get('/employees/{id}', [EmployeesController::class, 'show']);

    // Mengedit resource tertentu berrdasarkan id
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);

    // Menghapus resource tertentu berrdasarkan id
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);

    // Mencari resource tertentu berdasarkan nama
    Route::get('/employees/search/{name}', [EmployeesController::class, 'search']);

    // Menampilkan resource yang memiliki status active
    Route::get('/employees/status/active', [EmployeesController::class, 'active']);

    // Menampilkan resource yang memiliki status inactive
    Route::get('/employees/status/inactive', [EmployeesController::class, 'inactive']);

    // Menampilkan resource yang memiliki status terminated
    Route::get('/employees/status/terminated', [EmployeesController::class, 'terminated']);
});
