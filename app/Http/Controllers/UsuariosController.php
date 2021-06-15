<?php

namespace App\Http\Controllers;

use App\Models\Entity\Empresa;
use App\Models\Entity\Roles;
use App\Models\Entity\UsuarioRol;
use App\Models\Entity\Usuarios;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('usuarios');

        if(session()->get('Rol_Nombre') == 'Super Administrador'){
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->select('ru.*', 'u.*')
                ->groupBy('u.id')
                ->get();
        }else{
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                ->select('ru.*', 'u.*')
                ->groupBy('u.id')
                ->get();
        }
        
        return view('theme.back.usuarios.listar', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        if($request->ajax()){
            can('crear_usuario');
            $roles = Roles::get();
            $empresas = Empresa::get();
            return view('theme.back.usuarios.crear', compact('roles', 'empresas'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_usuario')){
                $usuario = Usuarios::create([
                    'USR_Tipo_Documento_Usuario' => $request->USR_Tipo_Documento_Usuario,
                    'USR_Documento_Usuario' => $request->USR_Documento_Usuario,
                    'USR_Fecha_Vencimiento_Licencia_Usuario' => $request->USR_Fecha_Vencimiento_Licencia_Usuario,
                    'USR_Nombres_Usuario' => $request->USR_Nombres_Usuario,
                    'USR_Apellidos_Usuario' => $request->USR_Apellidos_Usuario,
                    'USR_Fecha_Nacimiento_Usuario' => $request->USR_Fecha_Nacimiento_Usuario,
                    'USR_Direccion_Residencia_Usuario' => $request->USR_Direccion_Residencia_Usuario,
                    'USR_Telefono_Usuario' => $request->USR_Telefono_Usuario,
                    'USR_Correo_Usuario' => $request->USR_Correo_Usuario,
                    'USR_Nombre_Usuario' => $request->USR_Nombre_Usuario,
                    'password' => Hash::make($request->USR_Nombre_Usuario),
                    'USR_Empresa_Id' => $request->USR_Empresa_Id,
                    'USR_Conductor_Fijo_Usuario' => $request->has('USR_Conductor_Fijo_Usuario')
                ]);
                UsuarioRol::create([
                    'USR_RL_Usuario_Id' => $usuario->id,
                    'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
                    'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
                ]);

                return $this->vista(Lang::get('messages.UserCreated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('editar_usuario')){
                $usuario = DB::table('TBL_Usuario as u')
                    ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->leftJoin('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->where('u.id', $id)
                    ->select('ru.*', 'r.*', 'u.*')
                    ->first();
                
                if($usuario){
                    $roles = Roles::get();
                    $empresas = Empresa::get();
                    
                    return view('theme.back.usuarios.editar', compact('usuario', 'roles', 'empresas'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.UserNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('editar_usuario')){
                $usuario = Usuarios::findOrFail($id);

                if($usuario){
                    $usuario->update([
                        'USR_Tipo_Documento_Usuario' => $request->USR_Tipo_Documento_Usuario,
                        'USR_Documento_Usuario' => $request->USR_Documento_Usuario,
                        'USR_Fecha_Vencimiento_Licencia_Usuario' => $request->USR_Fecha_Vencimiento_Licencia_Usuario,
                        'USR_Nombres_Usuario' => $request->USR_Nombres_Usuario,
                        'USR_Apellidos_Usuario' => $request->USR_Apellidos_Usuario,
                        'USR_Fecha_Nacimiento_Usuario' => $request->USR_Fecha_Nacimiento_Usuario,
                        'USR_Direccion_Residencia_Usuario' => $request->USR_Direccion_Residencia_Usuario,
                        'USR_Telefono_Usuario' => $request->USR_Telefono_Usuario,
                        'USR_Correo_Usuario' => $request->USR_Correo_Usuario,
                        'USR_Nombre_Usuario' => $request->USR_Nombre_Usuario,
                        'USR_Empresa_Id' => $request->USR_Empresa_Id,
                        'USR_Conductor_Fijo_Usuario' => $request->has('USR_Conductor_Fijo_Usuario')
                    ]);

                    $rol = UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)->first();
                    if($rol){
                        UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)->first()
                            ->update([
                                'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
                                'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
                            ]);
                    }else{
                        UsuarioRol::create([
                            'USR_RL_Usuario_Id' => $usuario->id,
                            'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
                            'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
                        ]);
                    }
                    
                    return $this->vista(Lang::get('messages.User').' '.$usuario->USR_Nombres_Usuario.' '.Lang::get('messages.Updated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.UserNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('eliminar_usuario')){
                try {
                    Usuarios::destroy($id);

                    return response()->json(['mensaje'=>Lang::get('messages.UserDeleted'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                } catch (QueryException $ex) {
                    try {
                        $roles = UsuarioRol::where('USR_RL_Usuario_Id', $id)->get();
                        foreach ($roles as $rol) {
                            $rol->delete();
                        }
                        Usuarios::destroy($id);
    
                        return response()->json(['mensaje'=>Lang::get('messages.UserDeleted'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                    } catch (QueryException $ex) {
                        $roles = UsuarioRol::where('USR_RL_Usuario_Id', $id)->get();
                        foreach ($roles as $rol) {
                            $rol->update([
                                'USR_RL_Estado' => 0
                            ]);
                        }
                        return response()->json(['mensaje'=>Lang::get('messages.UserInactive'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeWarning')]);
                    }
                }
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        if(session()->get('Rol_Nombre') == 'Super Administrador'){
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->select('ru.*', 'u.*')
                ->groupBy('u.id')
                ->get();
        }else{
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                ->select('ru.*', 'u.*')
                ->groupBy('u.id')
                ->get();
        }
        return response()->json(['view'=>view('theme.back.usuarios.table-data')->with('usuarios', $usuarios)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            if(session()->get('Rol_Nombre') == 'Super Administrador'){
                $usuarios = DB::table('TBL_Usuario as u')
                    ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->select('ru.*', 'u.*')
                    ->groupBy('u.id')
                    ->get();
            }else{
                $usuarios = DB::table('TBL_Usuario as u')
                    ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                    ->select('ru.*', 'u.*')
                    ->groupBy('u.id')
                    ->get();
            }
            return view('theme.back.usuarios.table-data', compact('usuarios'))->render();
        }
    }

    public function asignar($id)
    {
        can('roles_asignar');
        try {
            $usuarioId = Crypt::decrypt($id);
            $usuario = Usuarios::findOrFail($usuarioId);

            if($usuario){
                $roles = DB::table('TBL_Rol as r')
                    ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Rol_Id', 'r.id')
                    ->leftJoin('TBL_Usuario as u', 'u.id', 'ru.USR_RL_Usuario_Id')
                    ->select('ru.*', 'r.*')
                    ->orderBy('r.RL_Nombre_Rol')
                    ->groupBy('r.id')
                    ->get();
                return view('theme.back.usuarios.roles', compact('usuario', 'roles'));
            }
            return redirect()->route('usuarios')->withErrors(Lang::get('messages.UserNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('usuarios')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function guardarAsignar(Request $request, $id)
    {
        try {
            $usuarioId = Crypt::decrypt($id);
            $usuario = Usuarios::findOrFail($usuarioId);

            if($usuario){
                $roles = Roles::get();
                foreach ($roles as $rol) {
                    if($request->has('cbx_'.$rol->id)) {
                        if(!$this->verificarRol($usuarioId, $rol->id)){
                            UsuarioRol::create([
                                'USR_RL_Usuario_Id' => $usuarioId,
                                'USR_RL_Rol_Id' => $rol->id
                            ]);
                        }
                    } else {
                        if($this->verificarRol($usuarioId, $rol->id)){
                            UsuarioRol::where('USR_RL_Usuario_Id', $usuarioId)
                                ->where('USR_RL_Rol_Id', $rol->id)
                                ->first()->delete();
                        }
                    }
                }
                
                return redirect()
                    ->route('usuarios')
                    ->with('mensaje', Lang::get('messages.AssignedRoles'));
            }
            return redirect()->route('usuarios')->withErrors(Lang::get('messages.UserNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('usuarios')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    private function verificarRol($usuarioId, $rolId){
        $rol = UsuarioRol::where('USR_RL_Usuario_Id', $usuarioId)
            ->where('USR_RL_Rol_Id', $rolId)
            ->first();
        
        if($rol){
            return true;
        }
        return false;
    }
}
