<?php

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

Route::apiResource('/produtos', \App\Http\Controllers\Api\ProdutoController::class);
Route::get('/produto/id/{id}', [\App\Http\Controllers\Api\ProdutoController::class, 'searchId']);
Route::get('/produto/name/{name}', [\App\Http\Controllers\Api\ProdutoController::class, 'searchName']);
Route::get('/produto/tags/{tags}', [\App\Http\Controllers\Api\ProdutoController::class, 'searchTag']);