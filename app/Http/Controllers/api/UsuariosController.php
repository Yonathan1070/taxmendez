<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Models\Entity\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerConductores()
    {
        $conductores = Usuarios::from('TBL_Usuario as u')
            ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
            ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
            ->select('u.*')
            ->with('empresa')
            ->with('roles')
            ->where('r.RL_Slug_Rol', 'conductor')
            ->orderBy('u.USR_Nombres_Usuario')
            ->get();
        return $this->sendResponse($conductores, 'Completado correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
