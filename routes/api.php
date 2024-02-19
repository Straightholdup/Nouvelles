<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthorController;

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
Route::prefix('v1')
    ->namespace('App\Http\Controllers\V1')
    ->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/login', [AuthController::class, 'login']);
        });

        Route::resource('/categories', CategoryController::class)->only([
            'index', 'show'
        ]);
        Route::resource('/authors', AuthorController::class)->only([
            'index', 'show'
        ]);
        Route::resource('/news', NewsController::class)->only([
            'index', 'show'
        ]);

        Route::middleware('auth:sanctum')->group(function () {
            Route::resource('/categories', CategoryController::class)->except([
                'index', 'show'
            ]);
            Route::resource('/authors', AuthorController::class)->except([
                'index', 'show'
            ]);
            Route::resource('/news', NewsController::class)->except([
                'index', 'show'
            ]);

        });
    });
