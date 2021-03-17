<?php

namespace App\Http\Controllers;

use App\Models\Entity\Empresa;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $empresas = Empresa::get();

        return view('theme.back.empresas.listar', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.empresas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $empresa = Empresa::where('EMP_Nit_Empresa', $request->EMP_Nit_Empresa)
            ->orWhere('EMP_Nombre_Empresa', $request->EMP_Nombre_Empresa)
            ->first();
        
        if($empresa){
            return redirect()->route('crear_empresa')->withErrors(Lang::get('messages.CompanyExists'))
                ->withInput();
        }

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

        Empresa::create([
            'EMP_Nombre_Empresa' => $request->EMP_Nombre_Empresa,
            'EMP_NIT_Empresa' => $request->EMP_NIT_Empresa,
            'EMP_Telefono_Empresa' => $request->EMP_Telefono_Empresa,
            'EMP_Direccion_Empresa' => $request->EMP_Direccion_Empresa,
            'EMP_Correo_Empresa' => $request->EMP_Correo_Empresa,
            'EMP_Logo_Empresa' => $imagenComoBase64,
            'EMP_Logo_Texto_Empresa' => $textoLogoComoBase64
        ]);

        return redirect()->route('empresas')->with('mensaje', Lang::get('messages.CreatedCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('editar_empresa');
        try {
            $empresaId = Crypt::decrypt($id);
            $empresa = Empresa::findOrFail($empresaId);

            if($empresa){
                return view('theme.back.empresas.editar', compact('empresa'));
            } else {
                return redirect()->route('empresas')->withErrors(Lang::get('messages.CompanyNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('empresas')->withErrors(Lang::get('messages.IdNotValid'));
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
            $empresaId = Crypt::decrypt($id);
            $empresa = Empresa::findOrFail($empresaId);

            if($empresa){
                $empresaDistintoId = Empresa::where('id', '!=', $empresa->id)
                    ->where(function($q) use($request) {
                        $q->where('EMP_NIT_Empresa', $request->EMP_NIT_Empresa)
                          ->orWhere('EMP_Nombre_Empresa', $request->EMP_Nombre_Empresa);
                    })
                    ->first();
                
                if($empresaDistintoId){
                    return redirect()->route('editar_empresa', ['id'=>Crypt::encrypt($empresa->id)])->withErrors('Placa o Número interno ya registrados.')
                        ->withInput();
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

                $empresa->update([
                    'EMP_Nombre_Empresa' => $request->EMP_Nombre_Empresa,
                    'EMP_NIT_Empresa' => $request->EMP_NIT_Empresa,
                    'EMP_Telefono_Empresa' => $request->EMP_Telefono_Empresa,
                    'EMP_Direccion_Empresa' => $request->EMP_Direccion_Empresa,
                    'EMP_Correo_Empresa' => $request->EMP_Correo_Empresa,
                    'EMP_Logo_Empresa' => $imagenComoBase64,
                    'EMP_Logo_Texto_Empresa' => $textoLogoComoBase64
                ]);

                return redirect()->route('empresas')->with('mensaje', Lang::get('messages.Company').' '.$empresa->EMP_Nombre_Empresa.' '.Lang::get('messages.Updated'.'.'));
            } else {
                return redirect()->route('empresas')->withErrors(Lang::get('messages.CompanyNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    
    public function editarEmpresa()
    {
        $empresa = Empresa::find(session()->get('Empresa_Id'));

        if($empresa){
            return view('theme.back.administracion.empresa', compact('empresa'));
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
}
