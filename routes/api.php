<?php
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\CommentController;
use App\Http\Controllers\API\V1\AuthController as V1AuthController;
use Illuminate\Routing\Middleware\SubstituteBindings;
Route::prefix('api')->group(function () {

    Route::get('/healthcheck', function () {
        return response()->json(['status' => 'OK'], 200);
    });
    Route::prefix('v1')->group(function () {

        Route::post('/register', [V1AuthController::class, 'register']);
        Route::post('/login', [V1AuthController::class, 'login']);

        Route::middleware(['auth:api'])->group(function () {
            Route::apiResource('tasks', TaskController::class);
            Route::apiResource('tasks.comments', CommentController::class)->shallow();

            Route::post('/logout', [V1AuthController::class, 'logout']);
            Route::get('/user', [V1AuthController::class, 'user']);
        });
    });
});
