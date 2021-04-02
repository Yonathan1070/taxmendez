<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Entity\CanalNotificacion;
use App\Models\Entity\UsuarioCanalNotificacion;
use App\Models\Entity\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $canalesAsignados = DB::table('TBL_Canal_Notificacion as cn')
            ->join('TBL_Usuario_Canal_Notificacion as ucn', 'ucn.USR_CNT_Canal_Id', 'cn.id')
            ->join('TBL_Usuario as u', 'u.id', 'ucn.USR_CNT_Usuario_Id')
            ->where('u.id', $datosUsuario->id)
            ->select('ucn.*', 'cn.*')
            ->orderBy('cn.created_at')
            ->get();

        $canales = CanalNotificacion::where('CNT_Habilitado_Canal_Notificacion', 1)->get();

        $canalesNoAsignados = [];
        foreach ($canales as $canal) {
            if(!$canalesAsignados->contains('id', $canal->id)) {
                array_push($canalesNoAsignados, $canal);
            }
        }
        
        
        return view('theme.back.administracion.perfil', compact('datosUsuario', 'canalesAsignados', 'canalesNoAsignados'));
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
    public function actualizarFotoPerfil(Request $request)
    {
        if($request->has('USR_Foto_Perfil_Usuario') && $request->USR_Foto_Perfil_Usuario != null){
            if (Str::contains($request->USR_Foto_Perfil_Usuario, 'base64')){
                $strBase64 = Str::of($request->USR_Foto_Perfil_Usuario)->explode('base64');
                $base64 = substr($strBase64[1],1);
                Usuarios::findOrFail(session()->get('Usuario_Id'))
                    ->update(['USR_Foto_Perfil_Usuario' => $base64]);

                return response()
                    ->json([
                        'success' => true,
                        'message' => Lang::get('messages.ImageUpdated'),
                        'title' => Lang::get('TaxMendez'),
                        'type' => 'success',
                        'image' => $base64
                    ]);
            } else {
                $rules = [
                    'USR_Foto_Perfil_Usuario' =>
                        'required|image|mimes:jpeg,png,jpg,gif,svg',//|max:2048
                ];
                $messages = [
                    'required' => Lang::get('messages.ImageRequired'),
                    'image' => Lang::get('messages.ImageType'),
                    'mimes' => Lang::get('messages.Mimes'),
                ];
                $validator = Validator::make(
                    $request->all(), 
                    $rules, 
                    $messages
                );
                
                if ($validator->passes()) {
                    $imagen = getimagesize($request->USR_Foto_Perfil_Usuario);
                    $ancho = $imagen[0];
                    $alto = $imagen[1];

                    $contenidoBinario = file_get_contents($request->USR_Foto_Perfil_Usuario);
                    $imagenComoBase64 = base64_encode($contenidoBinario);
                    if($ancho == $alto){
                        Usuarios::findOrFail(session()->get('Usuario_Id'))
                            ->update(['USR_Foto_Perfil_Usuario' => $imagenComoBase64]);
                        
                        return response()
                            ->json([
                                'success' => true,
                                'message' => Lang::get('messages.ImageUpdated'),
                                'title' => Lang::get('TaxMendez'),
                                'type' => 'success',
                                'image' => $imagenComoBase64
                            ]);
                    } else{
                        return response()
                            ->json([
                                'success' => false,
                                'message' => Lang::get('messages.HeightEqualsWidth'),
                                'title' => Lang::get('TaxMendez'),
                                'type' => 'success',
                                'image' => $imagenComoBase64
                            ]);
                    }
                }

                return response()
                    ->json([
                        'success' => false,
                        'message' => $validator->errors()->first(),
                        'title' => Lang::get('TaxMendez'),
                        'type' => 'error'
                    ]);
            }
        }
        else{
            return response()
                ->json([
                    'success' => false,
                    'message' => Lang::get('messages.ImageRequired'),
                    'title' => Lang::get('TaxMendez'),
                    'type' => 'error'
                ]);
        }
    }

    public function guardarAlertas(Request $request)
    {
        $usuario = Usuarios::find(session()->get('Usuario_Id'));

        if($usuario){
            $canales = CanalNotificacion::where('CNT_Habilitado_Canal_Notificacion', 1)->get();
            foreach ($canales as $canal) {
                if($request->has('cbx_'.$canal->id)) {
                    if(!$this->verificarCanal($usuario->id, $canal->id)){
                        UsuarioCanalNotificacion::create([
                            'USR_CNT_Usuario_Id' => $usuario->id,
                            'USR_CNT_Canal_Id' => $canal->id
                        ]);
                    }
                } else {
                    if($this->verificarCanal($usuario->id, $canal->id)){
                        $usuario->canales()->detach($canal->id);
                    }
                }
            }
                
            return redirect()
                ->route('perfil')
                ->with('mensaje', Lang::get('messages.AssignedChannels'));
        }
        return redirect()->route('perfil')->with('mensaje', Lang::get('messages.UserNotExists'));
    }

    private function verificarCanal($usuarioId, $canalId){
        $canal = UsuarioCanalNotificacion::where('USR_CNT_Usuario_Id', $usuarioId)
            ->where('USR_CNT_Canal_Id', $canalId)
            ->first();
        
        if($canal){
            return true;
        }
        return false;
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
