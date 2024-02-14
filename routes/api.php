<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccommodationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/auth/user', function(Request $request) {
        return auth()->user();
    });
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    //api routes
    Route::get('/accommodations', [AccommodationController::class, 'index']);
    Route::get('/accommodations/{id}', [AccommodationController::class, 'show']);
    Route::post('/accommodations', [AccommodationController::class, 'store']);
    Route::put('/accommodations/{id}', [AccommodationController::class, 'update']);
    Route::delete('/accommodations/{id}', [AccommodationController::class, 'destroy']);
});
