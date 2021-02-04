<?php

namespace App\Http\Controllers;

use App\Models\Entity\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('roles');

        $roles = Roles::get();

        return view(
            'theme.back.roles.listar',
            compact(
                'roles'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('crear_rol');
        return view('theme.back.roles.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        Roles::create([
            'RL_Nombre_Rol' => $request->RL_Nombre_Rol,
            'RL_Descripcion_Rol' => $request->RL_Descripcion_Rol
        ]);

        return redirect()
            ->route('crear_rol')
            ->with('mensaje', Lang::get('messages.CreatedRol'));
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
