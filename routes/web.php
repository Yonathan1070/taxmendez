<?php

use App\Http\Controllers\Administracion\AdministracionController;
use App\Http\Controllers\Administracion\PerfilUsuarioController;
use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\CanalNotificacionController;
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
    Route::post('/canal-notificacion', [PerfilUsuarioController::class, 'guardarAlertas'])->name('guardar_alertas_usuario');
});
Route::group(['prefix' => '/roles', 'middleware' => ['auth']], function () {
    Route::get('', [RolesController::class, 'index'])->name('roles');
    Route::get('page', [RolesController::class, 'page'])->name('page_roles');
    Route::post('/crear', [RolesController::class, 'crear'])->name('crear_rol');
    Route::put('/{id}/editar', [RolesController::class, 'editar'])->name('editar_rol');
    Route::post('', [RolesController::class, 'guardar'])->name('guardar_rol');
    Route::put('/{id}', [RolesController::class, 'actualizar'])->name('actualizar_rol');
    Route::delete('/{id}/eliminar', [RolesController::class, 'eliminar'])->name('eliminar_rol');
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
    Route::get('/listado', [PermisosController::class, 'listar'])->name('permisos');
    Route::get('page', [PermisosController::class, 'page'])->name('page_permisos');
    Route::post('/crear', [PermisosController::class, 'crear'])->name('crear_permiso');
    Route::put('/{id}/editar', [PermisosController::class, 'editar'])->name('editar_permiso');
    Route::post('', [PermisosController::class, 'guardar'])->name('guardar_permiso');
    Route::put('/{id}', [PermisosController::class, 'actualizar'])->name('actualizar_permiso');
    Route::delete('/{id}/eliminar', [PermisosController::class, 'eliminar'])->name('eliminar_permiso');

    Route::get('/asignar/{id}', [PermisosController::class, 'index'])->name('permisos_usuario');
    Route::get('/ordenarmenu', [PermisosController::class, 'ordenarMenu'])->name('ordenar_menu');
    Route::get('iconos', [PermisosController::class, 'iconos'])->name('iconos');
    Route::post('/{id}/guardar', [PermisosController::class, 'guardarPermiso'])->name('guardar_permisos_usuario');
    Route::post('/guardarorden', [PermisosController::class, 'guardarOrden'])->name('guardar_orden');
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
            Route::post('/editar/{idGasto}', [AutomovilController::class, 'editarGastos'])->name('editar_gastos');
        });
        Route::post('/balance-anual', [AutomovilController::class, 'balanceAnual'])->name('balance_anual');
        Route::post('/balance-diario', [AutomovilController::class, 'balanceDiario'])->name('balance_diario');
        Route::put('/editar-datos/{idTurno}', [AutomovilController::class, 'actualizarDatos'])->name('actualizar_datos');
        Route::post('/balance-diario/pdf', [AutomovilController::class, 'pfdBalanceDiario'])->name('balance_diario_pdf');
        Route::post('/balance-mensual/pdf', [AutomovilController::class, 'pfdBalanceMensual'])->name('balance_mensual_pdf');
        Route::post('/balance-anual/pdf', [AutomovilController::class, 'pdfBalanceAnual'])->name('balance_anual_pdf');
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
    Route::get('page', [EmpresasController::class, 'page'])->name('page_empresas');
    Route::post('/crear', [EmpresasController::class, 'crear'])->name('crear_empresa');
    Route::put('/{id}/editar', [EmpresasController::class, 'editar'])->name('editar_empresa');
    Route::post('', [EmpresasController::class, 'guardar'])->name('guardar_empresa');
    Route::put('/{id}', [EmpresasController::class, 'actualizar'])->name('actualizar_empresa');
    //Route::delete('/{id}/eliminar', [RolesController::class, 'eliminar'])->name('eliminar_rol');

    Route::get('/editar', [EmpresasController::class, 'editarEmpresa'])->name('editar_empresa_usuario');
    Route::put('/editar-usuario', [EmpresasController::class, 'actualizarEmpresa'])->name('actualizar_empresa_usuario');
    Route::post('logo', [EmpresasController::class, 'actualizarLogo'])->name('actualizar_logo_empresa');
    Route::post('logo-texto', [EmpresasController::class, 'actualizarLogoTexto'])->name('actualizar_logo_texto_empresa');
    Route::put('/editar-servidor-correo', [EmpresasController::class, 'actualizarServidorCorreo'])->name('actualizar_servidor_correo');
});
Route::group(['prefix' => '/canal-notificacion', 'middleware' => ['auth']], function () {
    Route::get('', [CanalNotificacionController::class, 'index'])->name('canal_notificacion');
    Route::get('/crear', [CanalNotificacionController::class, 'crear'])->name('crear_canal_notificacion');
    Route::get('/editar/{id}', [CanalNotificacionController::class, 'editar'])->name('editar_canal_notificacion');
    Route::post('/crear', [CanalNotificacionController::class, 'guardar'])->name('guardar_canal_notificacion');
    Route::put('/editar/{id}', [CanalNotificacionController::class, 'actualizar'])->name('actualizar_canal_notificacion');
});

Route::get('idioma/{idioma}', [IdiomaController::class, 'cambiar'])->name('cambiar_idioma');