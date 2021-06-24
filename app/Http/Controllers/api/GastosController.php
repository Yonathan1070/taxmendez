<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\api\GastosRequest;
use App\Models\Entity\Automovil;
use App\Models\Entity\Gastos;
use App\Models\Entity\Mensualidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GastosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $automovil = Automovil::find($id);

        if($automovil){
            if($this->isNullOrEmpty($request->Fecha_Mes)){
                return $this->sendError('El mes es requerido.', 200);
            }
            if($request->all() && !$this->isNullOrEmpty($request->Fecha_Mes)){
                if($request->has('Fecha_Mes') && !$this->isNullOrEmpty($request->Fecha_Mes) && (Carbon::createFromFormat('Y-m-d', $request->Fecha_Mes)->format('Y-m') > Carbon::now()->format('Y-m'))){
                    return $this->sendError('El mes seleccionado no puede se mayor al mes actual.', 200);
                }
            }
            $gastos = Gastos::where('GST_Automovil_Id', $id)->where('GST_Mes_Anio_Gasto', $request->Fecha_Mes)->with('automovil')->get();
            return $this->sendResponse($gastos, 'Completado Correctamente.');
        }
        return $this->sendError('El automovil no existe!', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerGasto($id, $idGasto)
    {
        $automovil = Automovil::find($id);

        if($automovil){
            $gasto = Gastos::where('id', $idGasto)
                ->where('GST_Automovil_Id', $id)
                ->first();
            
            if($gasto){
                $gasto->automovil;

                $mensualidad = Mensualidad::where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('Y-m-d', $gasto->GST_Mes_Anio_Gasto)->format('Y-m').'-01')
                    ->where('MNS_Automovil_Id', $id)
                    ->first();
                
                if(!$mensualidad){
                    return $this->sendResponse($gasto, 'Completado correctamente.');
                }
                return $this->sendError('No es posible editar el gasto, ya se generó la mensualidad!', 200);
            }
            return $this->sendError('El gasto no existe!', 200);
        }
        return $this->sendError('El automovil no existe!', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editarGasto(Request $request, $id, $idGasto)
    {
        $datos = $request->all();
        $automovil = Automovil::find($id);

        if($automovil){
            $gasto = Gastos::where('id', $idGasto)
                ->where('GST_Automovil_Id', $id)->first();
            if($gasto){
                $validacion = new GastosRequest();
                $validator = Validator::make($datos, $validacion->rules(), $validacion->messages());
                if($validator->passes()){
                    $gasto->update([
                        'GST_Descripcion_Gasto' => $request->Descripcion,
                        'GST_Costo_Gasto' => $request->Costo
                    ]);

                    $gasto->automovil;

                    return $this->sendResponse($gasto, 'Gasto actualizado correctamente.');
                }
                return $this->sendError($validator->errors()->first(), 200);
            }
            return $this->sendError('El gasto no existe!', 200);
        }
        return $this->sendError('El automovil no existe!', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agregarGasto(Request $request, $id)
    {
        $datos = $request->all();
        $automovil = Automovil::find($id);

        if($automovil){
            $validacion = new GastosRequest();
            $validator = Validator::make($datos, $validacion->rules(), $validacion->messages());
            if($validator->passes()){
                $mensualidad = Mensualidad::where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('Y-m-d', $request->Fecha)->format('Y-m').'-01')
                    ->where('MNS_Automovil_Id', $id)
                    ->first();
                
                if(!$mensualidad){
                    Gastos::create([
                        'GST_Automovil_Id' => $id,
                        'GST_Mes_Anio_Gasto' => $request->Fecha,
                        'GST_Descripcion_Gasto' => $request->Descripcion,
                        'GST_Costo_Gasto' => $request->Costo
                    ]);
                    return $this->sendResponse(null, 'Gasto agregado correctamente.');
                }
                return $this->sendError('No es posible agregar gastos, ya se generó la mensualidad!', 200);
            }
            return $this->sendError($validator->errors()->first(), 200);
        }
        return $this->sendError('El automovil no existe!', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function isNullOrEmpty($str)
    {
        if(is_null($str) || empty($str)){
            return true;
        }

        return false;
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
