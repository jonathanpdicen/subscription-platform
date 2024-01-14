<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\SubscriberController;
use App\Http\Controllers\Api\V1\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    Route::apiResource('websites', WebsiteController::class);

    Route::apiResource('websites.posts', PostController::class)
        ->only('store');

    Route::post('websites/{website}/subscribe', SubscriberController::class);

    Route::put('posts/{post}/publish', [PostController::class, 'publish']);
});