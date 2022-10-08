<?php

use App\Http\Controllers\Api\V1\LanguagesController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\PostController;
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

Route::prefix('v1')->group(function () {
    Route::get('languages', [LanguagesController::class, 'index']);

    Route::apiResource('posts', PostController::class);
    Route::apiResource('tags', TagController::class);
});

