<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;

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

Route::controller(ClientController::class)->prefix('client')->name('client.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{clientId}', 'show')->name('show');
    Route::put('/{clientId}', 'update')->name('update');
    Route::post('/', 'create')->name('create');
    Route::delete('/{clientId}', 'destroy')->name('destroy');
});
