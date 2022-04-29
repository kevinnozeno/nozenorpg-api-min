<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserCharacterController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/testToken', function (Request $request) {
    return 'token is good';
});

Route::resources([
    'users' => UserController::class,
    'characters' => CharacterController::class,
    'rooms' => RoomController::class
]);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Pivots
//Route::get('/users/{user}/users/{user}', [CharacterController::class, 'showOfUser']);

Route::prefix('users/{user}')->group(function () {
    Route::resources([
        'characters' => UserCharacterController::class,
    ]);

    Route::patch('/characters/{character}/attack', [ActionController::class, 'attack']);
    Route::patch('/characters/{character}/cast', [ActionController::class, 'cast']);
    Route::patch('/characters/{character}/heal', [ActionController::class, 'heal']);
});


