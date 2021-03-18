<?php

use App\Http\Controllers\Administracion\AdministracionController;
use App\Http\Controllers\Administracion\PerfilUsuarioController;
use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\DesinfeccionController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('theme.back.general.login');
});
Route::group(['prefix' => '/setting', 'middleware' => ['auth']], function () {
    Route::get('obtener-setting/{nick}', [SettingController::class, 'obtenerSetting'])->name('obtener_setting');
});
Route::group(['prefix' => '/administracion', 'middleware' => ['auth']], function () {
    Route::get('/', [AdministracionController::class, 'index'])->name('administracion');
    Route::get('perfil', [PerfilUsuarioController::class, 'index'])->name('perfil');
    Route::put('perfil', [PerfilUsuarioController::class, 'actualizarPerfil'])->name('actualizar_perfil');
    Route::post('foto-perfil', [PerfilUsuarioController::class, 'actualizarFotoPerfil'])->name('actualizar_foto_perfil');
    Route::post('cambiar-pswd', [PerfilUsuarioController::class, 'cambiarContrasena'])->name('actualizar_contrasena');
    Route::get('/obtenermensuales', [AdministracionController::class, 'datosMensuales'])->name('obtener_datos_mensuales');
    Route::get('descargar-app', [AdministracionController::class, 'descargarApp'])->name('descargar_app');
});
Route::group(['prefix' => '/roles', 'middleware' => ['auth']], function () {
    Route::get('', [RolesController::class, 'index'])->name('roles');
    Route::get('/crear', [RolesController::class, 'crear'])->name('crear_rol');
    Route::post('/crear', [RolesController::class, 'guardar'])->name('guardar_rol');
});
Route::group(['prefix' => '/usuarios', 'middleware' => ['auth']], function () {
    Route::get('', [UsuariosController::class, 'index'])->name('usuarios');
    Route::get('/crear', [UsuariosController::class, 'crear'])->name('crear_usuario');
    Route::get('/editar/{id}', [UsuariosController::class, 'editar'])->name('editar_usuario');
    Route::get('/asignarroles/{id}', [UsuariosController::class, 'asignar'])->name('asignar_rol');
    Route::post('/crear', [UsuariosController::class, 'guardar'])->name('guardar_usuario');
    Route::post('/asignarroles/{id}', [UsuariosController::class, 'guardarAsignar'])->name('guardar_asignar_rol');
    Route::put('/editar/{id}', [UsuariosController::class, 'actualizar'])->name('actualizar_usuario');
});
Route::group(['prefix' => '/permisos', 'middleware' => ['auth']], function () {
    Route::get('/asignar/{id}', [PermisosController::class, 'index'])->name('permisos_usuario');
    Route::get('/listado', [PermisosController::class, 'listar'])->name('permisos');
    Route::get('/crear', [PermisosController::class, 'crear'])->name('crear_permiso');
    Route::get('/editar/{id}', [PermisosController::class, 'editar'])->name('editar_permiso');
    Route::get('/ordenarmenu', [PermisosController::class, 'ordenarMenu'])->name('ordenar_menu');
    Route::get('iconos', [PermisosController::class, 'iconos'])->name('iconos');
    Route::post('/{id}/guardar', [PermisosController::class, 'guardarPermiso'])->name('guardar_permisos_usuario');
    Route::post('/crear', [PermisosController::class, 'guardar'])->name('guardar_permiso');
    Route::post('/guardarorden', [PermisosController::class, 'guardarOrden'])->name('guardar_orden');
    Route::put('/editar/{id}', [PermisosController::class, 'actualizar'])->name('actualizar_permiso');
});
Route::group(['prefix' => '/automoviles', 'middleware' => ['auth']], function () {
    Route::get('', [AutomovilController::class, 'index'])->name('automoviles');
    Route::get('/crear', [AutomovilController::class, 'crear'])->name('crear_automovil');
    Route::get('/editar/{id}', [AutomovilController::class, 'editar'])->name('editar_automovil');
    Route::get('/obtenerfoto/{id}', [AutomovilController::class, 'obtener_foto'])->name('obtener_foto_automovil');
    Route::get('/asignar-propietarios/{id}', [AutomovilController::class, 'asignar'])->name('propietarios_automovil');
    Route::post('/crear', [AutomovilController::class, 'guardar'])->name('guardar_automovil');
    Route::post('/asignar-propietarios/{id}', [AutomovilController::class, 'guardarAsignar'])->name('guardar_asignacion_automovil');
    Route::put('/editar/{id}', [AutomovilController::class, 'actualizar'])->name('actualizar_automovil');
    Route::group(['prefix' => '/balance/{id}'], function () {
        Route::get('/', [AutomovilController::class, 'balance'])->name('balance');
        Route::get('/obtener-datos', [AutomovilController::class, 'obtenerTurnoCalendar'])->name('balance_obtener_datos');
        Route::get('/agregar-datos/{fecha}', [AutomovilController::class, 'formularioDatos'])->name('formulario_datos');
        Route::get('/editar-datos/{idTurno}', [AutomovilController::class, 'formularioDatosEditar'])->name('formulario_datos_editar');
        Route::post('/agregar-datos', [AutomovilController::class, 'agregarDatos'])->name('balance_agregar_datos');
        Route::post('/editar-datos', [AutomovilController::class, 'editarDatos'])->name('balance_editar_datos');
        Route::post('/agregar-datos/{fecha}', [AutomovilController::class, 'guardarDatos'])->name('guardar_datos');
        Route::post('/verificar-dias', [AutomovilController::class, 'verificarDias'])->name('verificar_dias');
        Route::post('/generar', [AutomovilController::class, 'generarBalance'])->name('generar_balance');
        Route::group(['prefix' => '/gastos'], function () {
            Route::post('/agregar', [AutomovilController::class, 'agregarGastos'])->name('agregar_gastos');
            Route::get('/agregar-gastos', [AutomovilController::class, 'agregarGastos'])->name('agregar_gastos_sesion');
            Route::post('/guardar', [AutomovilController::class, 'guardarGastos'])->name('guardar_gastos');
        });
        Route::post('/balance-anual', [AutomovilController::class, 'balanceAnual'])->name('balance_anual');
        Route::post('/balance-diario', [AutomovilController::class, 'balanceDiario'])->name('balance_diario');
        Route::put('/editar-datos/{idTurno}', [AutomovilController::class, 'actualizarDatos'])->name('actualizar_datos');
        Route::post('/balance-diario/pdf', [AutomovilController::class, 'pfdBalanceDiario'])->name('balance_diario_pdf');
        Route::post('/balance-mensual/pdf', [AutomovilController::class, 'pfdBalanceMensual'])->name('balance_mensual_pdf');
    });
});
Route::group(['prefix' => '/turnos', 'middleware' => ['auth']], function () {
    Route::get('', [TurnosController::class, 'index'])->name('turnos');
    Route::get('/crear', [TurnosController::class, 'crear'])->name('crear_turno');
    Route::get('/editar/{id}', [TurnosController::class, 'editar'])->name('editar_turno');
    Route::post('/crear', [TurnosController::class, 'guardar'])->name('guardar_turno');
    Route::put('/editar/{id}', [TurnosController::class, 'actualizar'])->name('actualizar_turno');
});
Route::group(['prefix' => '/desinfeccion', 'middleware' => ['auth']], function () {
    Route::get('', [DesinfeccionController::class, 'index'])->name('control_desinfeccion');
    Route::get('/crear', [DesinfeccionController::class, 'crear'])->name('crear_desinfeccion');
    Route::get('/editar/{id}', [DesinfeccionController::class, 'editar'])->name('editar_desinfeccion');
    Route::post('/crear', [DesinfeccionController::class, 'guardar'])->name('guardar_desinfeccion');
    Route::put('/editar/{id}', [DesinfeccionController::class, 'actualizar'])->name('actualizar_desinfeccion');
});
Route::group(['prefix' => '/empresas', 'middleware' => ['auth']], function () {
    Route::get('', [EmpresasController::class, 'index'])->name('empresas');
    Route::get('/crear', [EmpresasController::class, 'crear'])->name('crear_empresa');
    Route::get('/editar/{id}', [EmpresasController::class, 'editar'])->name('editar_empresa');
    Route::post('/crear', [EmpresasController::class, 'guardar'])->name('guardar_empresa');
    Route::put('/editar/{id}', [EmpresasController::class, 'actualizar'])->name('actualizar_empresa');
    Route::get('/editar', [EmpresasController::class, 'editarEmpresa'])->name('editar_empresa_usuario');
    Route::put('/editar-usuario', [EmpresasController::class, 'actualizarEmpresa'])->name('actualizar_empresa_usuario');
    Route::post('logo', [EmpresasController::class, 'actualizarLogo'])->name('actualizar_logo_empresa');
    Route::post('logo-texto', [EmpresasController::class, 'actualizarLogoTexto'])->name('actualizar_logo_texto_empresa');
});

Route::get('idioma/{idioma}', [IdiomaController::class, 'cambiar'])->name('cambiar_idioma');