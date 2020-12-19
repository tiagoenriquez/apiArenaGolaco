<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UsuarioController::class, 'logar']);
Route::get('reserva/usuario={usuario}&horario={horario}', [ReservaController::class, 'listarPorUsuario']);
Route::get('reserva/data={data}', [ReservaController::class, 'listarPorData']);
Route::post('usuario/procurar-por-cpf', [UsuarioController::class, 'procurarPorCpf']);
Route::resource('usuario', UsuarioController::class);
Route::resource('reserva', ReservaController::class);