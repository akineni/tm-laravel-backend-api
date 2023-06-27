<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->group(function() {
    Route::post('/', [UserController::class, 'authenticate']);
    Route::get('/refresh', [UserController::class, 'refreshToken']);
});

Route::middleware('auth:sanctum')->group(function (){

    Route::controller(TaskController::class)->group(function() {

        Route::get('tasks/','get');
    
        Route::prefix('task')->group(function() {
            
            Route::post('/','add');
            Route::put('/{task_id}','update');
            Route::put('/completed/{task_id}','completed');
            Route::delete('/{task_id}','delete');
            
        });
        
    });

});