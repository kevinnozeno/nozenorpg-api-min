<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CharacterController;
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
    'characters' => CharacterController::class
]);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::patch('/characters/{character}/users/{user}/attack', [ActionController::class, 'attack']);
Route::patch('/characters/{character}/users/{user}/cast', [ActionController::class, 'cast']);
Route::patch('/characters/{character}/users/{user}/heal', [ActionController::class, 'heal']);

Route::get('/characters/{character}/users/{user}', [CharacterController::class, 'showOfUser']);
