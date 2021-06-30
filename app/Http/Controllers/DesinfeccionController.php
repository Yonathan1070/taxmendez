<?php

namespace App\Http\Controllers;

use App\Models\Entity\ControlDesinfeccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class DesinfeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(can2('control_desinfeccion')){
            if(session()->get('Rol_Nombre') == 'Super Administrador'){
                $tablaControl = ControlDesinfeccion::from('TBL_Control_Desinfeccion as cd')
                    ->join('TBL_Automovil as a', 'a.id', 'cd.CTD_Automovil_Id')
                    ->join('TBL_Usuario as u', 'u.id', 'cd.CTD_Usuario_Id')
                    ->select('a.*', 'u.*', 'cd.*')
                    ->get();
            }else{
                $tablaControl = ControlDesinfeccion::from('TBL_Control_Desinfeccion as cd')
                    ->join('TBL_Automovil as a', 'a.id', 'cd.CTD_Automovil_Id')
                    ->join('TBL_Usuario as u', 'u.id', 'cd.CTD_Usuario_Id')
                    ->where('u.USR_Empresa_Id', session()->get('Empresa_Id'))
                    ->where('a.AUT_Empresa_Id', session()->get('Empresa_Id'))
                    ->select('a.*', 'u.*', 'cd.*')
                    ->get();
            }
            
            return view('theme.back.desinfeccion.listar', compact('tablaControl'));
        }
        return redirect()->route('administracion')->withErrors(Lang::get('messages.AccessDenied'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        //
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
    public function editar($id)
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
    public function actuaizar(Request $request, $id)
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
