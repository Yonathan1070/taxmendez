<?php

namespace App\Http\Controllers;

use App\Models\Entity\Turno;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
        can('turnos');

        $turnos = Turno::orderByDesc('TRN_Valor_Turno')->paginate(10);

        return view('theme.back.turnos.listar', compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_turno')){
                return view('theme.back.turnos.crear');
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
            if(can2('crear_turno')){
                DB::beginTransaction();

                $turnos = Turno::get();
                foreach ($turnos as $turno) {
                    if(Str::lower($turno->TRN_Nombre_Turno) == Str::lower($request->TRN_Nombre_Turno)){
                        DB::rollBack();
                        return response()->json(['mensaje'=>Lang::get('messages.TurnExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                    }
                }
                $nuevoTurno = Turno::crear($request);
                if($nuevoTurno){
                    DB::commit();
                    return $this->vista(Lang::get('messages.TurnAdded'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                }
                DB::rollBack();
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
            if(can2('editar_turno')){
                $turno = Turno::findOrFail($id);
                if($turno){
                    return view('theme.back.turnos.editar', compact('turno'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.TurnNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('editar_turno')){
                DB::beginTransaction();

                $turno = Turno::find($id);
                if($turno){
                    $turnos = Turno::where('id', '!=', $id)->get();
                    foreach ($turnos as $turnoLista) {
                        if(Str::lower($turnoLista->TRN_Nombre_Turno) == Str::lower($request->TRN_Nombre_Turno)){
                            DB::rollBack();
                            return response()->json(['mensaje'=>Lang::get('messages.TurnExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                        }
                    }
                    $turnoEditado = Turno::editar($turno, $request);
                    if($turnoEditado){
                        DB::commit();
                        return $this->vista(Lang::get('messages.TurnUpdated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.TurnNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('eliminar_turno')){
                DB::beginTransaction();
                if(Turno::eliminar($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.DeletedTurn'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.TurnNotDelete'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        $turnos = Turno::orderByDesc('TRN_Valor_Turno')->paginate(10);
        return response()->json(['view'=>view('theme.back.turnos.table-data')->with('turnos', $turnos)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $turnos = Turno::orderByDesc('TRN_Valor_Turno')->paginate(10);
            return view('theme.back.turnos.table-data', compact('turnos'))->render();
        }
    }
}
