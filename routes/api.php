<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;

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


Route::post('v1/auth/token', [AuthController::class, 'getToken']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('v1/livros', [LivroController::class, 'index']);
    Route::post('v1/livros', [LivroController::class, 'store']);
    Route::put('v1/livros/{livro}', [LivroController::class, 'update']);
    Route::delete('v1/livros/{livro}', [LivroController::class, 'destroy']);
    Route::post('v1/indices', [IndiceController::class, 'store']);
    Route::post('v1/livros/{livroId}/importar-indices-xml', [LivroController::class, 'importarIndicesXML']);
});


