<?php

use App\Http\Controllers\api\AutomovilController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\TurnosController;
use App\Http\Controllers\api\UsuariosController;
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

/*
    Encryption keys generated successfully.
    Personal access client created successfully.
    Client ID: 1
    Client secret: 58UZZnEjN5IPY2bozKjJV1Ioxy0Q705hGkHoA3FK
    Password grant client created successfully.
    Client ID: 2
    Client secret: VW43l5v3KI4gbnGEi6ibWoP44tZURDAtDx32gLxT
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:api');
Route::group(['prefix' => 'automoviles', 'middleware' => ['auth:api']], function () {
    Route::get('/', [AutomovilController::class, 'index']);
    Route::group(['prefix' => '{id}'], function () {
        Route::group(['prefix' => 'balance'], function () {
            Route::post('listar', [AutomovilController::class, 'listar']);
            Route::post('agregar', [AutomovilController::class, 'agregarBalance']);
            Route::get('obtener/{idBalance}', [AutomovilController::class, 'obtenerBalance']);
            Route::put('editar/{idBalance}', [AutomovilController::class, 'editarBalance']);
        });
    });
});
Route::group(['prefix' => 'conductores', 'middleware' => ['auth:api']], function () {
    Route::get('listar', [UsuariosController::class, 'obtenerConductores']);
});
Route::group(['prefix' => 'turnos', 'middleware' => ['auth:api']], function () {
    Route::get('listar', [TurnosController::class, 'obtenerTurnos']);
});
Route::get('usuario', [LoginController::class, 'usuario'])->middleware('auth:api');
