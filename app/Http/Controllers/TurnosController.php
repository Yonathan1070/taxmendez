<?php

namespace App\Http\Controllers;

use App\Models\Entity\Turno;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class TurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turnos = Turno::orderByDesc('TRN_Valor_Turno')->get();

        return view('theme.back.turnos.listar', compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.turnos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $turnos = Turno::get();
        foreach ($turnos as $turno) {
            if(Str::lower($turno->TRN_Nombre_Turno) == Str::lower($request->TRN_Nombre_Turno)){
                return redirect()->route('crear_turno')->withErrors('El turno ya existe.')->withInput();
            }
        }
        Turno::create([
            'TRN_Nombre_Turno' => $request->TRN_Nombre_Turno,
            'TRN_Slug_Turno' => Str::slug($request->TRN_Nombre_Turno, '_'),
            'TRN_Descripcion_Turno' => $request->TRN_Descripcion_Turno,
            'TRN_Color_Turno' => $request->TRN_Color_Turno,
            'TRN_Valor_Turno' => $request->TRN_Valor_Turno
        ]);

        return redirect()->route('crear_turno')->with('mensaje', Lang::get('messages.TurnAdded'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        try {
            $turnoId = Crypt::decrypt($id);
            $turno = Turno::findOrFail($turnoId);
            if($turno){
                return view('theme.back.turnos.editar', compact('turno'));
            }
            return redirect()->route('turnos')->withErrors(Lang::get('messages.TurnNotExists'));
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
            $turnoId = Crypt::decrypt($id);
            $turno = Turno::findOrFail($turnoId);
            if($turno){
                $turnos = Turno::where('id', '!=', $turnoId)->get();
                foreach ($turnos as $turnoLista) {
                    if(Str::lower($turnoLista->TRN_Nombre_Turno) == Str::lower($request->TRN_Nombre_Turno)){
                        return redirect()->route('editar_turno', ['id'=>Crypt::encrypt($turnoId)])->withErrors('El turno ya existe.')->withInput();
                    }
                }
                $turno->update([
                    'TRN_Nombre_Turno' => $request->TRN_Nombre_Turno,
                    'TRN_Slug_Turno' => Str::slug($request->TRN_Nombre_Turno, '_'),
                    'TRN_Descripcion_Turno' => $request->TRN_Descripcion_Turno,
                    'TRN_Color_Turno' => $request->TRN_Color_Turno,
                    'TRN_Valor_Turno' => $request->TRN_Valor_Turno
                ]);
                return redirect()->route('turnos')->with('mensaje', Lang::get('messages.TurnUpdated'));
            }
            return redirect()->route('turnos')->withErrors(Lang::get('messages.TurnNotExists'));
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
    public function destroy($id)
    {
        //
    }
}
