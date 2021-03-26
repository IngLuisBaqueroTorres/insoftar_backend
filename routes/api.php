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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');

});

Route::Resource('usuarios', 'API\UsuariosController');
Route::get('/usuarios', [App\Http\Controllers\API\UsuariosController::class, 'index']);
Route::get('/usuarios/{id}/usuario', [App\Http\Controllers\API\UsuariosController::class, 'find']);
Route::post('/usuarios/crear', [App\Http\Controllers\API\UsuariosController::class, 'store']);
Route::post('/usuarios/actualizar/{id}', [App\Http\Controllers\API\UsuariosController::class, 'update']);
Route::post('/usuarios/eliminar/{id}', [App\Http\Controllers\API\UsuariosController::class, 'destroy']);

