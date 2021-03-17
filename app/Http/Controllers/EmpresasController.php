<?php

namespace App\Http\Controllers;

use App\Models\Entity\Empresa;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Lang;

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
