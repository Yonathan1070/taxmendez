<?php

namespace App\Http\Controllers;

use App\Models\Entity\CanalNotificacion;
use App\Models\Entity\Empresa;
use App\Models\Entity\ServidorCorreo;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('empresas');

        $empresas = Empresa::orderBy('id')->paginate(10);

        return view('theme.back.empresas.listar', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_empresa')){
                return view('theme.back.empresas.crear');
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
            if(can2('crear_empresa')){
                DB::beginTransaction();
                $empresa = Empresa::where('EMP_Nit_Empresa', $request->EMP_Nit_Empresa)
                    ->orWhere('EMP_Nombre_Empresa', $request->EMP_Nombre_Empresa)
                    ->first();
                
                if(!$empresa){
                    $imagenComoBase64 = null;
                    if($request->EMP_Logo_Empresa){
                        $contenidoBinario = file_get_contents($request->EMP_Logo_Empresa);
                        $imagenComoBase64 = base64_encode($contenidoBinario);
                    }

                    $textoLogoComoBase64 = null;
                    if($request->EMP_Logo_Texto_Empresa){
                        $contenidoBinario = file_get_contents($request->EMP_Logo_Texto_Empresa);
                        $textoLogoComoBase64 = base64_encode($contenidoBinario);
                    }

                    $newEmpresa = Empresa::crear($request, $imagenComoBase64, $textoLogoComoBase64);

                    if($newEmpresa){
                        DB::commit();
                        return $this->vista(Lang::get('messages.CreatedCompany'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.CompanyExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('editar_empresa')){
                $empresa = Empresa::findOrFail($id);

                if($empresa){
                    return view('theme.back.empresas.editar', compact('empresa'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.CompanyNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('editar_empresa')){
                DB::beginTransaction();
                $empresa = Empresa::find($id);

                if($empresa){
                    $empresaDistintoId = Empresa::where('id', '!=', $empresa->id)
                        ->where(function($q) use($request) {
                            $q->where('EMP_NIT_Empresa', $request->EMP_NIT_Empresa)
                            ->orWhere('EMP_Nombre_Empresa', $request->EMP_Nombre_Empresa);
                        })
                        ->first();
                    
                    if($empresaDistintoId){
                        DB::rollBack();
                        return response()->json(['mensaje'=>Lang::get('messages.NitOrNameExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                    }

                    $imagenComoBase64 = null;
                    if($request->EMP_Logo_Empresa){
                        $contenidoBinario = file_get_contents($request->EMP_Logo_Empresa);
                        $imagenComoBase64 = base64_encode($contenidoBinario);
                    } else {
                        $imagenComoBase64 = $empresa->EMP_Logo_Empresa;
                    }

                    $textoLogoComoBase64 = null;
                    if($request->EMP_Logo_Texto_Empresa){
                        $contenidoBinario = file_get_contents($request->EMP_Logo_Texto_Empresa);
                        $textoLogoComoBase64 = base64_encode($contenidoBinario);
                    } else {
                        $textoLogoComoBase64 = $empresa->EMP_Logo_Texto_Empresa;
                    }

                    $empresaEditada = Empresa::editar($empresa, $request, $imagenComoBase64, $textoLogoComoBase64);

                    if($empresaEditada){
                        DB::commit();
                        return $this->vista(Lang::get('messages.Company').' '.$empresa->EMP_Nombre_Empresa.' '.Lang::get('messages.Updated').'.', Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.CompanyNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('eliminar_empresa')){
                DB::beginTransaction();
                if(Empresa::eliminar($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.DeletedCompany'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.CompanyNotDeleted'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }
    
    public function editarEmpresa()
    {
        $empresa = Empresa::find(session()->get('Empresa_Id'));
        $servidor = ServidorCorreo::where('SRC_Empresa_Servidor', session()->get('Empresa_Id'))->first();
        $canalCorreo = CanalNotificacion::where('CNT_Nick_Canal_Notificacion', 'like', '%correo%')->first();
        
        if($empresa){
            return view('theme.back.administracion.empresa', compact('empresa', 'servidor', 'canalCorreo'));
        } else {
            return redirect()->route('administracion')->withErrors(Lang::get('messages.CompanyNotExists'));
        }
    }

    public function actualizarEmpresa(Request $request)
    {
        $empresa = Empresa::find(session()->get('Empresa_Id'));

        if($empresa){
            if($request->EMP_NIT_Empresa == null){
                $request->EMP_NIT_Empresa = $empresa->EMP_NIT_Empresa;
            }
            if($request->EMP_Nombre_Empresa == null){
                $request->EMP_Nombre_Empresa = $empresa->EMP_Nombre_Empresa;
            }
            if($request->EMP_Correo_Empresa == null){
                $request->EMP_Correo_Empresa = $empresa->EMP_Correo_Empresa;
            }
            if($request->EMP_Telefono_Empresa == null){
                $request->EMP_Telefono_Empresa = $empresa->EMP_Telefono_Empresa;
            }
            if($request->EMP_Direccion_Empresa == null){
                $request->EMP_Direccion_Empresa = $empresa->EMP_Direccion_Empresa;
            }

            $empresa->update([
                'EMP_NIT_Empresa' => $request->EMP_NIT_Empresa,
                'EMP_Nombre_Empresa' => $request->EMP_Nombre_Empresa,
                'EMP_Correo_Empresa' => $request->EMP_Correo_Empresa,
                'EMP_Telefono_Empresa' => $request->EMP_Telefono_Empresa,
                'EMP_Direccion_Empresa' => $request->EMP_Direccion_Empresa
            ]);

            return redirect()->route('editar_empresa_usuario')->with('mensaje', Lang::get('messages.CompanyUpdated'));
        } else {
            return redirect()->route('administracion')->withErrors(Lang::get('messages.CompanyNotExists'));
        }
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        $empresas = Empresa::orderBy('id')->paginate(10);
        return response()->json(['view'=>view('theme.back.empresas.table-data')->with('empresas', $empresas)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    public function actualizarLogo(Request $request)
    {
        if($request->has('EMP_Logo_Empresa') && $request->EMP_Logo_Empresa != null){
            if (Str::contains($request->EMP_Logo_Empresa, 'base64')){
                $strBase64 = Str::of($request->EMP_Logo_Empresa)->explode('base64');
                $base64 = substr($strBase64[1],1);
                Empresa::find(session()->get('Empresa_Id'))
                    ->update(['EMP_Logo_Empresa' => $base64]);

                return response()
                    ->json([
                        'success' => true,
                        'message' => Lang::get('messages.LogoUpdated'),
                        'title' => Lang::get('TaxMendez'),
                        'type' => 'success',
                        'image' => $base64
                    ]);
            } else {
                $rules = [
                    'EMP_Logo_Empresa' =>
                        'required|image|mimes:jpeg,png,jpg,gif,svg',//|max:2048
                ];
                $messages = [
                    'required' => Lang::get('messages.LogoRequired'),
                    'image' => Lang::get('messages.ImageType'),
                    'mimes' => Lang::get('messages.Mimes'),
                ];
                $validator = Validator::make(
                    $request->all(), 
                    $rules, 
                    $messages
                );
                
                if ($validator->passes()) {
                    $imagen = getimagesize($request->EMP_Logo_Empresa);

                    $contenidoBinario = file_get_contents($request->EMP_Logo_Empresa);
                    $imagenComoBase64 = base64_encode($contenidoBinario);
                        
                    Empresa::find(session()->get('Empresa_Id'))
                        ->update(['EMP_Logo_Empresa' => $imagenComoBase64]);
                    
                    return response()
                        ->json([
                            'success' => true,
                            'message' => Lang::get('messages.LogoUpdated'),
                            'title' => Lang::get('TaxMendez'),
                            'type' => 'success',
                            'image' => $imagenComoBase64
                        ]);
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
                    'message' => Lang::get('messages.LogoRequired'),
                    'title' => Lang::get('TaxMendez'),
                    'type' => 'error'
                ]);
        }
    }

    public function actualizarLogoTexto(Request $request)
    {
        if($request->has('EMP_Logo_Texto_Empresa') && $request->EMP_Logo_Texto_Empresa != null){
            if (Str::contains($request->EMP_Logo_Texto_Empresa, 'base64')){
                $strBase64 = Str::of($request->EMP_Logo_Texto_Empresa)->explode('base64');
                $base64 = substr($strBase64[1],1);
                Empresa::find(session()->get('Empresa_Id'))
                    ->update(['EMP_Logo_Texto_Empresa' => $base64]);

                return response()
                    ->json([
                        'success' => true,
                        'message' => Lang::get('messages.TextLogoUpdated'),
                        'title' => Lang::get('TaxMendez'),
                        'type' => 'success',
                        'image' => $base64
                    ]);
            } else {
                $rules = [
                    'EMP_Logo_Texto_Empresa' =>
                        'required|image|mimes:jpeg,png,jpg,gif,svg',//|max:2048
                ];
                $messages = [
                    'required' => Lang::get('messages.TextLogoRequired'),
                    'image' => Lang::get('messages.ImageType'),
                    'mimes' => Lang::get('messages.Mimes'),
                ];
                $validator = Validator::make(
                    $request->all(), 
                    $rules, 
                    $messages
                );
                
                if ($validator->passes()) {
                    $imagen = getimagesize($request->EMP_Logo_Texto_Empresa);

                    $contenidoBinario = file_get_contents($request->EMP_Logo_Texto_Empresa);
                    $imagenComoBase64 = base64_encode($contenidoBinario);
                        
                    Empresa::find(session()->get('Empresa_Id'))
                        ->update(['EMP_Logo_Texto_Empresa' => $imagenComoBase64]);
                    
                    return response()
                        ->json([
                            'success' => true,
                            'message' => Lang::get('messages.TextLogoUpdated'),
                            'title' => Lang::get('TaxMendez'),
                            'type' => 'success',
                            'image' => $imagenComoBase64
                        ]);
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
                    'message' => Lang::get('messages.TextLogoRequired'),
                    'title' => Lang::get('TaxMendez'),
                    'type' => 'error'
                ]);
        }
    }

    public function actualizarServidorCorreo(Request $request){
        $servidor = ServidorCorreo::where('SRC_Empresa_Servidor', session()->get('Empresa_Id'))->first();

        if($servidor){
            if($request->SRC_Driver_Servidor == null){
                $request->SRC_Driver_Servidor = $servidor->SRC_Driver_Servidor;
            }
            if($request->SRC_Host_Servidor == null){
                $request->SRC_Host_Servidor = $servidor->SRC_Host_Servidor;
            }
            if($request->SRC_Puerto_Servidor == null){
                $request->SRC_Puerto_Servidor = $servidor->SRC_Puerto_Servidor;
            }
            if($request->SRC_Nombre_Usuario_Servidor == null){
                $request->SRC_Nombre_Usuario_Servidor = $servidor->SRC_Nombre_Usuario_Servidor;
            }
            if($request->SRC_Password_Servidor == null){
                $request->SRC_Password_Servidor = $servidor->SRC_Password_Servidor;
            }
            if($request->SRC_Encriptacion_Servidor == null){
                $request->SRC_Encriptacion_Servidor = $servidor->SRC_Encriptacion_Servidor;
            }
            if($request->SRC_Direccion_De_Servidor == null){
                $request->SRC_Direccion_De_Servidor = $servidor->SRC_Direccion_De_Servidor;
            }
            if($request->SRC_Nombre_De_Servidor == null){
                $request->SRC_Nombre_De_Servidor = $servidor->SRC_Nombre_De_Servidor;
            }

            $servidor->update([
                'SRC_Driver_Servidor' => $request->SRC_Driver_Servidor,
                'SRC_Host_Servidor' => $request->SRC_Host_Servidor,
                'SRC_Puerto_Servidor' => $request->SRC_Puerto_Servidor,
                'SRC_Nombre_Usuario_Servidor' => $request->SRC_Nombre_Usuario_Servidor,
                'SRC_Password_Servidor' => $request->SRC_Password_Servidor,
                'SRC_Encriptacion_Servidor' => $request->SRC_Encriptacion_Servidor,
                'SRC_Direccion_De_Servidor' => $request->SRC_Direccion_De_Servidor,
                'SRC_Nombre_De_Servidor' => $request->SRC_Nombre_De_Servidor
            ]);

            return redirect()->route('editar_empresa_usuario')->with('mensaje', Lang::get('messages.ServerEmailUpdated'));
        } else {
            ServidorCorreo::create([
                'SRC_Driver_Servidor' => $request->SRC_Driver_Servidor,
                'SRC_Host_Servidor' => $request->SRC_Host_Servidor,
                'SRC_Puerto_Servidor' => $request->SRC_Puerto_Servidor,
                'SRC_Nombre_Usuario_Servidor' => $request->SRC_Nombre_Usuario_Servidor,
                'SRC_Password_Servidor' => $request->SRC_Password_Servidor,
                'SRC_Encriptacion_Servidor' => $request->SRC_Encriptacion_Servidor,
                'SRC_Direccion_De_Servidor' => $request->SRC_Direccion_De_Servidor,
                'SRC_Nombre_De_Servidor' => $request->SRC_Nombre_De_Servidor,
                'SRC_Empresa_Servidor' => session()->get('Empresa_Id')
            ]);

            return redirect()->route('editar_empresa_usuario')->with('mensaje', Lang::get('messages.ServerEmailCreated'));
        }
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $empresas = Empresa::orderBy('id')->paginate(10);
            return view('theme.back.empresas.table-data', compact('empresas'))->render();
        }
    }
}
