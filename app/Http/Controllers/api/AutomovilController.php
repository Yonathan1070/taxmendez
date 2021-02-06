<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Http\Requests\api\BalanceRequest;
use App\Models\Entity\Automovil;
use App\Models\Entity\UsuarioAutomovilTurno;
use App\Models\Entity\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AutomovilController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $automoviles = Automovil::get();
        return $this->sendResponse($automoviles, 'Login correcto.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request, $id)
    {
        
        $automovil = Automovil::find($id);

        if($automovil){
            if($request->all()){
                if($request->has('Fecha_Inicio') && (Carbon::createFromFormat('Y-m-d', $request->Fecha_Inicio)->format('Y-m-d') > Carbon::now()->format('Y-m-d'))){
                    return $this->sendError('Error.', ['error'=>'La fecha de inicio no puede se mayor a la fecha actual.']);
                }
                if($request->has('Fecha_Fin') && !Carbon::createFromFormat('Y-m-d', $request->Fecha_Inicio)->equalTo(Carbon::createFromFormat('Y-m-d', $request->Fecha_Fin)->format('Y-m-d'))){
                    if(Carbon::createFromFormat('Y-m-d', $request->Fecha_Inicio)->format('Y-m-d') > Carbon::createFromFormat('Y-m-d', $request->Fecha_Fin)->format('Y-m-d')){
                        return $this->sendError('Error.', ['error'=>'La fecha de inicio no puede se mayor a la fecha de fin.']);
                    }
                }
            }
            
            $parametro = $automovil->id.', '.(($request->has('Fecha_Inicio')) ? "'".$request->Fecha_Inicio."'" : 'null').', '.(($request->has('Fecha_Fin')) ? "'".$request->Fecha_Fin."'" : 'null');
            
            $turnos = DB::select('CALL obtenerTurnos ('.$parametro.')');
            
            return $this->sendResponse(['turnos'=>$turnos], 'Completado correctamente!');
        }
        return $this->sendError('Error.', ['error'=>'El automovil no existe!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarBalance(Request $request, $id)
    {
        $datos = $request->all();
        $automovil = Automovil::find($id);

        if($automovil){
            $validacion = new BalanceRequest();
            $validator = Validator::make($datos, $validacion->rules($request->Conductor), $validacion->messages());
            if($validator->passes()){
                /*UsuarioAutomovilTurno::create([
                    'TRN_AUT_Automovil_Id' => $id,
                    'TRN_AUT_Kilometraje_Turno' => $request->Kilometraje_Total,
                    'TRN_AUT_Kilometros_Andados_Turno' => $request->Kilometraje_Turno,
                    'TRN_AUT_Producido_Turno' => $request->Producido,
                    'TRN_AUT_Usuario_Turno_Id' => $request->Conductor,
                    'TRN_AUT_Fecha_Turno' => $request->Fecha,
                    'TRN_AUT_Turno_Id' => $request->Turno,
                    'TRN_AUT_Observacion_Turno_Seleccionado' => $request->Observacion
                ]);*/
                return $this->sendResponse(null, 'Turno agregado correctamente.');
            }
            return $this->sendError('Error.', ['error'=>$validator->errors()->all()]);
        }
        return $this->sendError('Error.', ['error'=>'El automovil no existe!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function obtenerBalance($id, $idBalance)
    {
        $automovil = Automovil::find($id);

        if($automovil){
            $balance = UsuarioAutomovilTurno::where('id', $idBalance)
                ->where('TRN_AUT_Automovil_Id', $id)
                ->first();
            
            $balance->conductor;
            $balance->automovil;
            $balance->turno;
            
            if($balance){
                return $this->sendResponse($balance, 'Completado correctamente.');
            }
            return $this->sendError('Error.', ['error'=>'El turno no existe!']);
        }
        return $this->sendError('Error.', ['error'=>'El automovil no existe!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editarBalance(Request $request, $id, $idBalance)
    {
        $datos = $request->all();
        $automovil = Automovil::find($id);

        if($automovil){
            $balance = UsuarioAutomovilTurno::where('id', $idBalance)
                ->where('TRN_AUT_Automovil_Id', $id)->first();
            if($balance){
                $validacion = new BalanceRequest();
                $validator = Validator::make($datos, $validacion->rules($request->Conductor), $validacion->messages());
                if($validator->passes()){
                    $balance->update([
                        'TRN_AUT_Automovil_Id' => $id,
                        'TRN_AUT_Kilometraje_Turno' => $request->Kilometraje_Total,
                        'TRN_AUT_Kilometros_Andados_Turno' => $request->Kilometraje_Turno,
                        'TRN_AUT_Producido_Turno' => $request->Producido,
                        'TRN_AUT_Usuario_Turno_Id' => $request->Conductor,
                        'TRN_AUT_Fecha_Turno' => $request->Fecha,
                        'TRN_AUT_Turno_Id' => $request->Turno,
                        'TRN_AUT_Observacion_Turno_Seleccionado' => $request->Observacion
                    ]);
                    return $this->sendResponse(null, 'Turno actualizado correctamente.');
                }
                return $this->sendError('Error.', ['error'=>$validator->errors()->all()]);
            }
            return $this->sendError('Error.', ['error'=>'El turno no existe!']);
        }
        return $this->sendError('Error.', ['error'=>'El automovil no existe!']);
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
