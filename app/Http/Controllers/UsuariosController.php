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
                ->orderBy('ru.USR_RL_Estado', 'desc')
                ->orderBy('u.USR_Nombres_Usuario')
                ->groupBy('u.id')
                ->get();
        }else{
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                ->select('ru.*', 'u.*')
                ->orderBy('ru.USR_RL_Estado', 'desc')
                ->orderBy('u.USR_Nombres_Usuario')
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
            if(can('crear_usuario')){
                $roles = Roles::get();
                $empresas = Empresa::get();
                return view('theme.back.usuarios.crear', compact('roles', 'empresas'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
                DB::beginTransaction();
                $usuario = Usuarios::crear($request);
                if($usuario){
                    $usuario_rol = UsuarioRol::crear($usuario, $request);
                    if($usuario_rol){
                        DB::commit();
                        return $this->vista(Lang::get('messages.UserCreated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
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
                DB::beginTransaction();
                $usuario = Usuarios::find($id);

                if($usuario){
                    $usuarioEditado = Usuarios::editar($usuario, $request);
                    if($usuarioEditado){
                        $rol = UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)->first();
                        if($rol){
                            $usuario_rol = UsuarioRol::editar($usuario, $request);
                        }else{
                            $usuario_rol = UsuarioRol::crear($usuario, $request);
                        }

                        if($usuario_rol){
                            DB::commit();
                            return $this->vista(Lang::get('messages.User').' '.$usuario->USR_Nombres_Usuario.' '.Lang::get('messages.Updated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                        }
                        DB::rollBack();
                    }
                    DB::rollBack();
                }
                DB::rollBack();
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
                DB::beginTransaction();
                if(Usuarios::eliminar($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.UserDeleted'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();
                    
                $roles = UsuarioRol::where('USR_RL_Usuario_Id', $id)->get();
                foreach ($roles as $rol) {
                    $rol->delete();
                }
                if(Usuarios::eliminar($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.UserDeleted'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();

                foreach ($roles as $rol) {
                    $rol->update([
                        'USR_RL_Estado' => 0
                    ]);
                }

                DB::commit();
                return response()->json(['mensaje'=>Lang::get('messages.UserInactive'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeWarning')]);
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
                ->orderBy('ru.USR_RL_Estado', 'desc')
                ->orderBy('u.USR_Nombres_Usuario')
                ->groupBy('u.id')
                ->get();
        }else{
            $usuarios = DB::table('TBL_Usuario as u')
                ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                ->select('ru.*', 'u.*')
                ->orderBy('ru.USR_RL_Estado', 'desc')
                ->orderBy('u.USR_Nombres_Usuario')
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
                    ->orderBy('ru.USR_RL_Estado', 'desc')
                    ->orderBy('u.USR_Nombres_Usuario')
                    ->groupBy('u.id')
                    ->get();
            }else{
                $usuarios = DB::table('TBL_Usuario as u')
                    ->leftJoin('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                    ->select('ru.*', 'u.*')
                    ->orderBy('ru.USR_RL_Estado', 'desc')
                    ->orderBy('u.USR_Nombres_Usuario')
                    ->groupBy('u.id')
                    ->get();
            }
            return view('theme.back.usuarios.table-data', compact('usuarios'))->render();
        }
    }

    public function asignar($id)
    {
        if(can2('roles_asignar')){
            $usuario = Usuarios::find($id);

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
        }
        return redirect()->route('usuarios')->withErrors(Lang::get('messages.AccessDenied'));
    }

    public function guardarAsignar(Request $request, $id)
    {
        if(can2('roles_asignar')){
            $usuario = Usuarios::find($id);

            if($usuario){
                $roles = Roles::get();
                foreach ($roles as $rol) {
                    if($request->has('cbx_'.$rol->id)) {
                        if(!$this->verificarRol($usuario->id, $rol->id)){
                            UsuarioRol::create([
                                'USR_RL_Usuario_Id' => $usuario->id,
                                'USR_RL_Rol_Id' => $rol->id
                            ]);
                        }
                    } else {
                        if($this->verificarRol($usuario->id, $rol->id)){
                            UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)
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
        }
        return redirect()->route('usuarios')->withErrors(Lang::get('messages.AccessDenied'));
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
