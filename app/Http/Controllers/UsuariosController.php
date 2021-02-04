<?php

namespace App\Http\Controllers;

use App\Models\Entity\Roles;
use App\Models\Entity\UsuarioRol;
use App\Models\Entity\Usuarios;
use Illuminate\Contracts\Encryption\DecryptException;
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

        $usuarios = DB::table('TBL_Usuario as u')
            ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
            ->select('ru.*', 'u.*')
            ->groupBy('u.id')
            ->get();
        return view('theme.back.usuarios.listar', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('crear_usuario');
        $roles = Roles::get();
        return view('theme.back.usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
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
            'USR_Empresa_Id' => 1,
            'USR_Conductor_Fijo_Usuario' => $request->has('USR_Conductor_Fijo_Usuario')
        ]);
        UsuarioRol::create([
            'USR_RL_Usuario_Id' => $usuario->id,
            'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
            'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
        ]);

        return redirect()
            ->route('crear_usuario')
            ->with('mensaje', Lang::get('messages.UserCreated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('editar_usuario');
        try {
            $usuarioId = Crypt::decrypt($id);

            $usuario = DB::table('TBL_Usuario as u')
                ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                ->where('u.id', $usuarioId)
                ->select('ru.*', 'r.*', 'u.*')
                ->first();
            
            if($usuario){
                $roles = Roles::get();
                
                return view('theme.back.usuarios.editar', compact('usuario', 'roles'));
            }
            return redirect()->route('usuarios')->with('mensaje', Lang::get('messages.UserNotExists'));

        } catch (DecryptException $e) {
            return redirect()->route('turnos')->withErrors(Lang::get('messages.IdNotValid'));
        }
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
        try {
            $usuarioId = Crypt::decrypt($id);
            $usuario = Usuarios::findOrFail($usuarioId);

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
                    'USR_Conductor_Fijo_Usuario' => $request->has('USR_Conductor_Fijo_Usuario')
                ]);

                UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)->first()
                    ->update([
                        'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
                        'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
                    ]);
                
                return redirect()
                    ->route('usuarios')
                    ->with('mensaje', Lang::get('messages.User').' '.$usuario->USR_Nombres_Usuario.' '.Lang::get('messages.Updated'));
            }
            return redirect()->route('usuarios')->with('mensaje', Lang::get('messages.UserNotExists'));

        } catch (DecryptException $e) {
            return redirect()->route('turnos')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
