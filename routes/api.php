<?php

use App\Http\Controllers\api\AutomovilController;
use App\Http\Controllers\api\ControlDesinfeccionController;
use App\Http\Controllers\api\GastosController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\TurnosController;
use App\Http\Controllers\api\UsuariosController;
use App\Models\Entity\ControlDesinfeccion;
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
            Route::delete('eliminar/{idBalance}', [AutomovilController::class, 'eliminarBalance']);
        });
        Route::group(['prefix' => 'gastos'], function () {
            Route::post('listar', [GastosController::class, 'index']);
            Route::post('agregar', [GastosController::class, 'agregarGasto']);
            Route::get('obtener/{idGasto}', [GastosController::class, 'obtenerGasto']);
            Route::put('editar/{idGasto}', [GastosController::class, 'editarGasto']);
            Route::delete('eliminar/{idGasto}', [GastosController::class, 'eliminarGasto']);
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
//Control Desinfeccion
Route::post('buscar-usuario', [ControlDesinfeccionController::class, 'findDriver']);
Route::post('guardar-control', [ControlDesinfeccionController::class, 'save']);
Route::get('buscar-usuario/{id}', [ControlDesinfeccionController::class, 'findById']);
Route::get('obtener-automoviles', [ControlDesinfeccionController::class, 'getCars']);
