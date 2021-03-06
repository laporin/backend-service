<?php

use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::get('/categories', 'CategoryController@index');
Route::get('/categories/{id}', 'CategoryController@show');

Route::get('/reports', 'ReportController@index');
Route::get('/reports/all', 'ReportController@all'); # for text similarity
Route::get('/reports/me', 'ReportController@me')->middleware('auth:sanctum');
Route::get('/reports/{id}', 'ReportController@show');
Route::post('/reports', 'ReportController@store')->middleware('auth:sanctum');
Route::put('/reports/{id}', 'ReportController@update')->middleware('auth:sanctum');
Route::delete('/reports/{id}', 'ReportController@destroy')->middleware('auth:sanctum');
