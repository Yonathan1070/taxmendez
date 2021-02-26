<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Entity\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class PerfilUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosUsuario = Usuarios::find(session()->get('Usuario_Id'));
        return view('theme.back.administracion.perfil', compact('datosUsuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actualizarPerfil(Request $request)
    {
        $user = Usuarios::find(session()->get('Usuario_Id'));
        if($request->USR_Nombres_Usuario == null){
            $request->USR_Nombres_Usuario = $user->USR_Nombres_Usuario;
        }
        if($request->USR_Apellidos_Usuario == null){
            $request->USR_Apellidos_Usuario = $user->USR_Apellidos_Usuario;
        }
        if($request->USR_Correo_Usuario == null){
            $request->USR_Correo_Usuario = $user->USR_Correo_Usuario;
        }
        if($request->USR_Telefono_Usuario == null){
            $request->USR_Telefono_Usuario = $user->USR_Telefono_Usuario;
        }
        if($request->USR_Direccion_Residencia_Usuario == null){
            $request->USR_Direccion_Residencia_Usuario = $user->USR_Direccion_Residencia_Usuario;
        }

        $user->update([
            'USR_Nombres_Usuario' => $request->USR_Nombres_Usuario,
            'USR_Apellidos_Usuario' => $request->USR_Apellidos_Usuario,
            'USR_Correo_Usuario' => $request->USR_Correo_Usuario,
            'USR_Telefono_Usuario' => $request->USR_Telefono_Usuario,
            'USR_Direccion_Residencia_Usuario' => $request->USR_Direccion_Residencia_Usuario
        ]);

        return redirect()->route('perfil')->with('mensaje', Lang::get('messages.ProfileUpdated'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cambiarContrasena(Request $request)
    {
        $user = Usuarios::find(session()->get('Usuario_Id'));

        if(Hash::check($request->OldPsw, $user->password)){
            if($request->NewPsw == $request->RetPsw){
                $user->update([
                    'password' => Hash::make($request->NewPsw)
                ]);

                return redirect()->route('perfil')->with('mensaje', Lang::get('messages.PasswordUpdated'));
            }
            return redirect()->route('perfil')->withErrors(Lang::get('messages.ErrorRetypePwsd'));
        }
        return redirect()->route('perfil')->withErrors(Lang::get('messages.ErrorPswdCheck'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
