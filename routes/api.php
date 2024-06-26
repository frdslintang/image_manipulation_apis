<?php

use App\Http\Controllers\V1\AlbumController;
use App\Http\Controllers\V1\ImageManipulationController;
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
//Route::apiResource('album', AlbumController::class);

//menerapkan version api
Route::prefix('v1')->group(function() {
    Route::apiResource('album', AlbumController::class);
    Route::get('image', [ImageManipulationController::class, 'index']);
    Route::get('image/by-album/{album}', [ImageManipulationController::class, 'byAlbum']); //berdasar album
    Route::get('image/{image}', [ImageManipulationController::class, 'show']);
    Route::post('image/resize', [ImageManipulationController::class, 'resize']);
    Route::delete('image/{image}', [ImageManipulationController::class, 'destroy']);


});


