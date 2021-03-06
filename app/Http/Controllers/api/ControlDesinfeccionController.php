<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Http\Requests\api\ControlDesinfeccionRequest;
use App\Models\Entity\Automovil;
use App\Models\Entity\ControlDesinfeccion;
use App\Models\Entity\Usuarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControlDesinfeccionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findDriver(Request $request)
    {
        $datos = $request->all();
        $rules = [
            'USR_Documento_Usuario' => 'required|regex:/^[0-9]+$/u'
        ];
        $messages = [
            'USR_Documento_Usuario.required' => 'El número de documento es requerido',
            'USR_Documento_Usuario.requex' => 'El número de documento debe contener solo números, sin puntos ni espacios'
        ];
        $validator = Validator::make($datos, $rules, $messages);
        if($validator->passes()){
            $conductor = Usuarios::where('USR_Documento_Usuario', $request->USR_Documento_Usuario)
                ->first();
            
            if($conductor){
                return $this->sendResponse($conductor, 'Completado Correctamente.');
            }
            return $this->sendError('El usuario que intenta buscar no existe.', 200);
        }
        return $this->sendError($validator->errors()->first(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $datos = $request->all();
        $validacion = new ControlDesinfeccionRequest();
        $validator = Validator::make($datos, $validacion->rules(), $validacion->messages());

        if($validator->passes()){
            ControlDesinfeccion::create([
                'CTD_Fecha_Hora_Desinfeccion' => Carbon::now()->format('Y-m-d h:m:s'),
                'CTD_Automovil_Id' => $request->CTD_Automovil_Id,
                'CTD_Usuario_Id' => $request->CTD_Usuario_Id,
                'CTD_Temperatura_Control_Desinfeccion' => $request->CTD_Temperatura_Control_Desinfeccion,
                'CTD_Firma_Control_Desinfeccion' => $request->CTD_Firma_Control_Desinfeccion
            ]);

            return $this->sendResponse(null, 'Completado Correctamente.');
        }
        return $this->sendError($validator->errors()->first(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findById($id)
    {
        $conductor = Usuarios::find($id);
            
        if($conductor){
            return $this->sendResponse($conductor, 'Completado Correctamente.');
        }
        return $this->sendError('El usuario que intenta buscar no existe.', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCars()
    {
        $automoviles = Automovil::get();
            
        return $this->sendResponse($automoviles, 'Completado Correctamente.');
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
