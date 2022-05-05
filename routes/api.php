<?php

use App\Http\Controllers\RoomableController;
use App\Http\Controllers\SkillController;
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
    'rooms' => RoomController::class,
    'roomables' => RoomableController::class,
    'skills' => SkillController::class,
]);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Pivots
//Route::get('/users/{user}/users/{user}', [CharacterController::class, 'showOfUser']);

Route::prefix('users/{user}')->group(function () {
    Route::resources([
        'characters' => UserCharacterController::class
    ], ['as' => 'users']);
});

Route::prefix('userCharacters/{userCharacter}')->group(function () {
    Route::post('/room/{room}', [UserCharacterController::class, 'join']);
    Route::patch('/room/{room}', [UserCharacterController::class, 'updateInRoom']);
    Route::delete('/room/{room}', [UserCharacterController::class, 'leave']);
});

Route::post('roomables/{roomable}/use/{skill}', [RoomableController::class, 'use']);


