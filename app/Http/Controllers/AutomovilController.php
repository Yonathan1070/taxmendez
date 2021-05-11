<?php

namespace App\Http\Controllers;

use App\Models\Entity\Automovil;
use App\Models\Entity\AutomovilPropietario;
use App\Models\Entity\Empresa;
use App\Models\Entity\Gastos;
use App\Models\Entity\Mensualidad;
use App\Models\Entity\Notificacion;
use App\Models\Entity\Turno;
use App\Models\Entity\UsuarioAutomovilTurno;
use App\Models\Entity\Usuarios;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

class AutomovilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('automoviles');
        session()->forget("FechaCalendario");
        if(session()->get('Rol_Nombre') == 'Super Administrador'){
            $automoviles = DB::table('TBL_Automovil as a')
                ->join('TBL_Empresa as e', 'e.id', 'a.AUT_Empresa_Id')
                ->select('e.*', 'a.*')
                ->get();
        }else{
            $automoviles = DB::table('TBL_Automovil as a')
                ->join('TBL_Empresa as e', 'e.id', 'a.AUT_Empresa_Id')
                ->where('a.AUT_Empresa_Id', session()->get('Empresa_Id'))
                ->select('e.*', 'a.*')
                ->get();
        }
        
        $conductores = DB::table('TBL_Usuario as u')
            ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
            ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
            ->where('r.RL_Nombre_Rol', 'Conductor')
            ->get()->count();

        return view('theme.back.automoviles.listar', compact('automoviles', 'conductores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('crear_automovil');

        $empresas = Empresa::get();
        return view('theme.back.automoviles.crear', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $automovil = Automovil::where('AUT_Placa_Automovil', $request->AUT_Placa_Automovil)
            ->orWhere('AUT_Numero_Interno_Automovil', $request->AUT_Numero_Interno_Automovil)
            ->first();
        
        if($automovil){
            return redirect()->route('crear_automovil')->withErrors(Lang::get('messages.LicensePlateExists'))
                ->withInput();
        }

        $imagenComoBase64 = null;
        if($request->AUT_Foto_Automovil){

            /*$archivo_Imagen = $request->AUT_Foto_Automovil;
            $imagen = Image::make($archivo_Imagen);
            $imagen->resize(200, 200, function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
            });
            Response::make($imagen->encode('jpeg', 50));*/
            $contenidoBinario = file_get_contents($request->AUT_Foto_Automovil);
            $imagenComoBase64 = base64_encode($contenidoBinario);
        }

        Automovil::create([
            'AUT_Placa_Automovil' => $request->AUT_Placa_Automovil,
            'AUT_Numero_Interno_Automovil' => $request->AUT_Numero_Interno_Automovil,
            'AUT_Fecha_Vencimiento_Soat_Automovil' => $request->AUT_Fecha_Vencimiento_Soat_Automovil,
            'AUT_Fecha_Vencimiento_Seguro_Actual_Automovil' => $request->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil,
            'AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil' => $request->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil,
            'AUT_Empresa_Id' => $request->AUT_Empresa_Id,
            'AUT_Foto_Automovil' => $imagenComoBase64
        ]);

        return redirect()->route('automoviles')->with('mensaje', Lang::get('messages.CreatedCar'));
    }

    /*public function obtener_foto($id)
    {
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                try{
                    return $automovil->AUT_Foto_Automovil;
                    
                    /*$archivo_Imagen = Image::make($image);
        
                    $response = Response::make($archivo_Imagen->encode('jpeg'));
                    $response->header('Content-Type', 'image/jpeg');
                } catch(Exception $ex){
                    $response = null;
                }

                return $response;
            } else {
                $response = null;
            }
        } catch (DecryptException $e) {
            $response = null;
        }
    }*/
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignar($id)
    {
        can('propietarios_asignar');
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $usuarios = DB::table('TBL_Usuario as u')
                    ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->where('r.RL_Nombre_Rol', 'Propietario')
                    ->select('u.*')
                    ->get();

                $propietarios = DB::table('TBL_Usuario as u')
                    ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->leftJoin('TBL_Automovil_Propietario as ap', 'ap.AUT_PRP_Propietario_Id', 'u.id')
                    ->where('r.RL_Nombre_Rol', 'Propietario')
                    ->where('ap.AUT_PRP_Automovil_Id', $automovil->id)
                    ->select('u.id')
                    ->get()->toArray();
                
                $usuariosArr = [];
                foreach($usuarios as $usuario) {
                    $key = array_search($usuario->id, array_column($propietarios, 'id'));
                    if ($key !== false && $key >= 0) {
                        $dataNew['id'] = $usuario->id;
                        $dataNew['USR_Nombres_Usuario'] = $usuario->USR_Nombres_Usuario;
                        $dataNew['USR_Apellidos_Usuario'] = $usuario->USR_Apellidos_Usuario;
                        $dataNew['AUT_PRP_Propietario_Id'] = $usuario->id;
                    }
                    else {
                        $dataNew['id'] = $usuario->id;
                        $dataNew['USR_Nombres_Usuario'] = $usuario->USR_Nombres_Usuario;
                        $dataNew['USR_Apellidos_Usuario'] = $usuario->USR_Apellidos_Usuario;
                        $dataNew['AUT_PRP_Propietario_Id'] = null;
                    }
                    array_push($usuariosArr, $dataNew);
                }
                return view('theme.back.automoviles.asignar', compact('automovil', 'usuariosArr'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function guardarAsignar(Request $request, $id)
    {
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $usuarios = DB::table('TBL_Usuario as u')
                    ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->where('r.RL_Nombre_Rol', 'Propietario')
                    ->select('u.*')
                    ->get();

                foreach ($usuarios as $usuario) {
                    if($request->has("cbx_$usuario->id")){
                        if(!$this->verificarAsignacion($automovil->id, $usuario->id)){
                            AutomovilPropietario::create([
                                'AUT_PRP_Automovil_Id' => $automovil->id,
                                'AUT_PRP_Propietario_Id' => $usuario->id
                            ]);
                        }
                    } else {
                        if($this->verificarAsignacion($automovil->id, $usuario->id)){
                            AutomovilPropietario::where('AUT_PRP_Propietario_Id', $usuario->id)
                                ->where('AUT_PRP_Automovil_Id', $automovil->id)
                                ->first()->delete();
                        }
                    }
                }
                return redirect()
                    ->route('automoviles')
                    ->with('mensaje', Lang::get('messages.OwnersAssigned'));
            }

            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    private function verificarAsignacion($automovilId, $propietarioId){
        $propietario = AutomovilPropietario::where('AUT_PRP_Propietario_Id', $propietarioId)
            ->where('AUT_PRP_Automovil_Id', $automovilId)
            ->first();
        
        if($propietario){
            return true;
        }
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('editar_automovil');
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $empresas = Empresa::get();

                return view('theme.back.automoviles.editar', compact('automovil', 'empresas'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
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
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $automovilDistintoId = Automovil::where('id', '!=', $automovil->id)
                    ->where(function($q) use($request) {
                        $q->where('AUT_Placa_Automovil', $request->AUT_Placa_Automovil)
                          ->orWhere('AUT_Numero_Interno_Automovil', $request->AUT_Numero_Interno_Automovil);
                    })
                    ->first();
                
                if($automovilDistintoId){
                    return redirect()->route('editar_automovil', ['id'=>Crypt::encrypt($automovil->id)])->withErrors('Placa o Número interno ya registrados.')
                        ->withInput();
                }

                $imagenComoBase64 = null;
                if($request->AUT_Foto_Automovil){
                    $contenidoBinario = file_get_contents($request->AUT_Foto_Automovil);
                    $imagenComoBase64 = base64_encode($contenidoBinario);
                } else {
                    $imagenComoBase64 = $automovil->AUT_Foto_Automovil;
                }

                $automovil->update([
                    'AUT_Placa_Automovil' => $request->AUT_Placa_Automovil,
                    'AUT_Numero_Interno_Automovil' => $request->AUT_Numero_Interno_Automovil,
                    'AUT_Fecha_Vencimiento_Soat_Automovil' => $request->AUT_Fecha_Vencimiento_Soat_Automovil,
                    'AUT_Fecha_Vencimiento_Seguro_Actual_Automovil' => $request->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil,
                    'AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil' => $request->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil,
                    'AUT_Empresa_Id' => $request->AUT_Empresa_Id,
                    'AUT_Foto_Automovil' => $imagenComoBase64
                ]);

                return redirect()->route('automoviles')->with('mensaje', Lang::get('messages.Car').' '.$automovil->AUT_Numero_Interno_Automovil.' '.Lang::get('messages.Updated'.'.'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
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
    public function balance($id)
    {
        can('balance');
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                Session::put(['Automovil_Id' => $automovil->id]);
                $mes = Carbon::now()->format('m');
                $anio = Carbon::now()->format('Y');

                $cantidadDias = $this->obtenerDiasMes($mes, $anio);
                $turnosRegistrados = UsuarioAutomovilTurno::where('TRN_AUT_Fecha_Turno', '>=', $anio.'-'.$mes.'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $anio.'-'.$mes.'-'.$cantidadDias)
                    ->get()
                    ->count();
                
                $boton = (($turnosRegistrados/2) >= $cantidadDias) ? 'block' : 'none';
                return view('theme.back.automoviles.balance', compact('automovil', 'boton'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function agregarDatos(Request $request, $id)
    {
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $fecha = $request->fecha;
                return route('formulario_datos', ['id'=>Crypt::encrypt($automovil->id), 'fecha'=>Crypt::encrypt($fecha)]);
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function formularioDatos($id, $fecha){
        can('balance');
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $fecha = Crypt::decrypt($fecha);

            if($automovil){
                Session::put([
                    'FechaCalendario' => $fecha
                ]);
                $conductores = DB::table('TBL_Usuario as u')
                    ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->where('r.RL_Nombre_Rol', 'Conductor')
                    ->where('ru.USR_RL_Estado', 1)
                    ->select('u.*')
                    ->get();
                
                $turnos = Turno::get();
                return view('theme.back.automoviles.agregar-datos', compact('automovil', 'fecha', 'conductores', 'turnos'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function guardarDatos(Request $request, $id, $fecha){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $fechaDecript = Crypt::decrypt($fecha);

            if($automovil){
                UsuarioAutomovilTurno::create([
                    'TRN_AUT_Automovil_Id' => $automovil->id,
                    'TRN_AUT_Kilometraje_Turno' => $request->TRN_AUT_Kilometraje_Turno,
                    'TRN_AUT_Kilometros_Andados_Turno' => $request->TRN_AUT_Kilometros_Andados_Turno,
                    'TRN_AUT_Producido_Turno' => $request->TRN_AUT_Producido_Turno,
                    'TRN_AUT_Usuario_Turno_Id' => $request->TRN_AUT_Usuario_Turno_Id,
                    'TRN_AUT_Fecha_Turno' => $fechaDecript,
                    'TRN_AUT_Turno_Id' => $request->TRN_AUT_Turno_Id,
                    'TRN_AUT_Observacion_Turno_Seleccionado' => $request->TRN_AUT_Observacion_Turno_Seleccionado
                ]);
                
                $cantidadDias = $this->obtenerDiasMes(Carbon::createFromFormat('Y-m-d', $fechaDecript)->format('m'), Carbon::createFromFormat('Y-m-d', $fechaDecript)->format('Y'));
                if(Carbon::createFromFormat('Y-m-d', $fechaDecript)->format('d') == $cantidadDias){
                    session()->forget("FechaCalendario");
                }

                $cantidadTurnos = UsuarioAutomovilTurno::where('TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fechaDecript)
                    ->get()
                    ->count();
                
                if($cantidadTurnos >= ($cantidadDias*2)){
                    $slugTurno = Turno::find($request->TRN_AUT_Turno_Id)->TRN_Slug_Turno;
                    if(Str::contains($slugTurno, 'Noche') || Str::contains($slugTurno, 'noche')){
                        $propietarios = $automovil->propietarios;
                        $informacion = [
                            'icono' => 'ico',
                            'titulo' => 'Cuadro Mensual',
                            'mensaje' => 'El cuadro por turnos está listo para verse.',
                            'tipo' => 'post',
                            'nombreParametro' => 'id',
                            'valorParametro' => $automovil->id,
                            'atributos' => json_encode([
                                'mesAnioTurnos' => Carbon::createFromFormat('Y-m-d', $fechaDecript)->format('m-Y')
                            ])
                        ];
                        foreach ($propietarios as $propietario) {
                            $canales = $propietario->canales;
                            foreach ($canales as $canal) {
                                if((Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'Web') || Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'web')) && $canal->CNT_Habilitado_Canal_Notificacion){
                                    Notificacion::enviarNotificacion(
                                        Usuarios::find(session()->get('Usuario_Id')),
                                        $propietario,
                                        $informacion
                                    );
                                }
                            }
                        }
                    }
                }

                return redirect()->route('balance', ['id'=>Crypt::encrypt($automovil->id)])->with('mensaje', Lang::get('messages.TurnAdded'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function obtenerTurnoCalendar($id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);
            
            if($automovil){
                $turno = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('TRN_AUT_Automovil_Id', $automovil->id)
                    ->select(
                        'uat.id',
                        DB::raw('CONCAT(u.USR_Nombres_Usuario, " ", u.USR_Apellidos_Usuario) as title'),
                        DB::raw('CONCAT(uat.TRN_AUT_Fecha_Turno, " ", "00:00") as start'),
                        DB::raw('CONCAT(uat.TRN_AUT_Fecha_Turno, " ", "23:59") as end'),
                        't.TRN_Color_Turno as color'
                    )
                    ->get();
                return Response::json($turno);
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function editarDatos(Request $request, $id)
    {
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);
            
            if($automovil){
                return route('formulario_datos_editar', ['id'=>Crypt::encrypt($automovil->id), 'idTurno'=>Crypt::encrypt($request->idTurnoAutomovil)]);
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function formularioDatosEditar($id, $idTurno){
        can('balance');
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $turnoId = Crypt::decrypt($idTurno);
            $turnoAutomovil = UsuarioAutomovilTurno::findOrFail($turnoId);
            
            if($automovil && $turnoAutomovil){
                $conductores = DB::table('TBL_Usuario as u')
                    ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                    ->join('TBL_Rol as r', 'r.id', 'ru.USR_RL_Rol_Id')
                    ->where('r.RL_Nombre_Rol', 'Conductor')
                    ->where('ru.USR_RL_Estado', 1)
                    ->select('u.*')
                    ->get();
                
                $turnos = Turno::get();
                $fecha = $turnoAutomovil->TRN_AUT_Fecha_Turno;

                return view('theme.back.automoviles.editar-datos', compact('automovil', 'fecha', 'conductores', 'turnos', 'turnoAutomovil'));
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function actualizarDatos(Request $request, $id, $idTurno){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $turnoId = Crypt::decrypt($idTurno);
            $turnoAutomovil = UsuarioAutomovilTurno::findOrFail($turnoId);

            if($automovil && $turnoAutomovil){
                $turnoAutomovil->update([
                    'TRN_AUT_Kilometraje_Turno' => $request->TRN_AUT_Kilometraje_Turno,
                    'TRN_AUT_Kilometros_Andados_Turno' => $request->TRN_AUT_Kilometros_Andados_Turno,
                    'TRN_AUT_Producido_Turno' => $request->TRN_AUT_Producido_Turno,
                    'TRN_AUT_Usuario_Turno_Id' => $request->TRN_AUT_Usuario_Turno_Id,
                    'TRN_AUT_Turno_Id' => $request->TRN_AUT_Turno_Id,
                    'TRN_AUT_Observacion_Turno_Seleccionado' => $request->TRN_AUT_Observacion_Turno_Seleccionado
                ]);
                
                $cantidadDias = $this->obtenerDiasMes(Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m'), Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('Y'));
                if(Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('d') == $cantidadDias){
                    session()->forget("FechaCalendario");
                }

                $cantidadTurnos = UsuarioAutomovilTurno::where('TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('Y-m').'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('Y-m').'-'.$cantidadDias)
                    ->get()
                    ->count();
                
                if($cantidadTurnos >= ($cantidadDias*2)){
                    $slugTurno = Turno::find($request->TRN_AUT_Turno_Id)->TRN_Slug_Turno;
                    
                    if((Str::contains($slugTurno, 'Noche') || Str::contains($slugTurno, 'noche')) || (Str::contains($slugTurno, 'dia') || Str::contains($slugTurno, 'dia'))){
                        $propietarios = $automovil->propietarios;
                        $informacion = [
                            'icono' => 'mdi mdi-cached',
                            'titulo' => 'MonthlyTable',
                            'mensaje' => 'MonthlyTableMessage',
                            'tipo' => 'post',
                            'ruta' => 'balance_diario',
                            'nombreParametro' => 'id',
                            'valorParametro' => $automovil->id,
                            'atributos' => json_encode([
                                'mesAnioTurnos' => Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m-Y')
                            ])
                        ];
                        foreach ($propietarios as $propietario) {
                            $canales = $propietario->canales;
                            foreach ($canales as $canal) {
                                if((Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'Web') || Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'web')) && $canal->CNT_Habilitado_Canal_Notificacion){
                                    Notificacion::enviarNotificacion(
                                        Usuarios::find(session()->get('Usuario_Id')),
                                        $propietario,
                                        $informacion
                                    );
                                }
                            }
                        }

                        $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                            ->where('GST_Mes_Anio_Gasto', '01-'.Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m-Y'))
                            ->get();

                        $sumaGastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                            ->where('GST_Mes_Anio_Gasto', '01-'.Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m-Y'))
                            ->select(
                                DB::raw('SUM(TBL_Gastos.GST_Costo_Gasto) as Gastos'),
                            )->groupBy('GST_Automovil_Id')
                            ->get();
                    
                        if($gastos->count() <= 0 || $sumaGastos->Gastos <= 0){
                            $propietarios = $automovil->propietarios;
                            $informacion = [
                                'icono' => 'mdi mdi-cash-multiple',
                                'titulo' => 'AddExpenses',
                                'mensaje' => 'AddExpensesMessage',
                                'tipo' => 'post',
                                'ruta' => 'agregar_gastos',
                                'nombreParametro' => 'id',
                                'valorParametro' => $automovil->id,
                                'atributos' => json_encode([
                                    'mesAnioGastos' => Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m-Y')
                                ])
                            ];
                            foreach ($propietarios as $propietario) {
                                $canales = $propietario->canales;
                                foreach ($canales as $canal) {
                                    if((Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'Web') || Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'web')) && $canal->CNT_Habilitado_Canal_Notificacion){
                                        Notificacion::enviarNotificacion(
                                            Usuarios::find(session()->get('Usuario_Id')),
                                            $propietario,
                                            $informacion
                                        );
                                    }
                                }
                            }
                        }

                        if($cantidadTurnos == ($cantidadDias*2)){
                            $propietarios = $automovil->propietarios;
                            $informacion = [
                                'icono' => 'mdi mdi-chart-histogram',
                                'titulo' => 'MonthlyGenerate',
                                'mensaje' => 'MonthlyGenerateMessage',
                                'tipo' => 'post',
                                'ruta' => 'generar_balance',
                                'nombreParametro' => 'id',
                                'valorParametro' => $automovil->id,
                                'atributos' => json_encode([
                                    'mesAnio' => Carbon::createFromFormat('Y-m-d', $turnoAutomovil->TRN_AUT_Fecha_Turno)->format('m-Y')
                                ])
                            ];
                            foreach ($propietarios as $propietario) {
                                $canales = $propietario->canales;
                                foreach ($canales as $canal) {
                                    if((Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'Web') || Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'web')) && $canal->CNT_Habilitado_Canal_Notificacion){
                                        Notificacion::enviarNotificacion(
                                            Usuarios::find(session()->get('Usuario_Id')),
                                            $propietario,
                                            $informacion
                                        );
                                    }
                                }
                            }
                        }
                    }
                }

                return redirect()->route('balance', ['id'=>Crypt::encrypt($automovil->id)])->with('mensaje', 'Datos del turno actualizados satisfactoriamente.');
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function verificarDias(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $cantidadDias = $this->obtenerDiasMes($request->mes, $request->anio);
                $turnosRegistrados = UsuarioAutomovilTurno::whereBetween('TRN_AUT_Fecha_Turno', [$request->anio.'-'.$request->mes.'-01', $request->anio.'-'.$request->mes.'-'.$cantidadDias])
                    ->get()
                    ->count();
                
                return Response::json((($turnosRegistrados/2) >= $cantidadDias) ? 100 : 0);
            } else {
                return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
            }
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    private function obtenerDiasMes($mes, $anio)
    {
       //Si la extensión que mencioné está instalada, usamos esa.
       if( is_callable("cal_days_in_month"))
       {
          return cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
       }
       else
       {
          //Lo hacemos a mi manera.
          return date("d",mktime(0,0,0,$mes+1,0,$anio));
       }
    }

    public function generarBalance(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                if($request->has('notificacion') && $request->notificacion == true){
                    Notificacion::find($request->notificacionId)->update([
                        'NTF_Visto_Notificacion' => 1
                    ]);
                }
                
                //Mensualidad
                $fecha = explode("-", $request->mesAnio);
                $cantidadDias = $this->obtenerDiasMes($fecha[0], $fecha[1]);

                $mensual = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno)/2 as DiasTrabajados'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/(SUM(t.TRN_Valor_Turno)/2)) as PromedioDia')
                    )
                    ->groupBy('uat.TRN_AUT_Automovil_Id')
                    ->first();
                
                $KM_Anterior = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Dia%')
                    ->select(
                        DB::raw('(uat.TRN_AUT_Kilometraje_Turno - uat.TRN_AUT_Kilometros_Andados_Turno) as KM_Anterior')
                    )
                    ->first();
                
                $KM_Ultimo = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Noche%')
                    ->select(
                        'uat.TRN_AUT_Kilometraje_Turno'
                    )
                    ->first();

                //Balance Trabajadores
                $conductores = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        'u.id',
                        'u.USR_Nombres_Usuario',
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno) as Turnos'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(t.TRN_Valor_Turno)) as PromedioTurno'),
                        DB::raw('null as turnosAsignados')
                    )
                    ->groupBy('u.id')
                    ->get();

                foreach ($conductores as $conductorTurno) {
                    $turnosConductor = DB::table('TBL_Usuario_Automovil_Turno as uat')
                        ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                        ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                        ->where('TRN_AUT_Usuario_Turno_Id', $conductorTurno->id)
                        ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                        ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                        ->where(function($q) {
                            $q->where('t.TRN_Slug_Turno', 'dia')
                              ->orWhere('t.TRN_Slug_Turno', 'noche');
                        })
                        ->select('t.*')
                        ->groupBy('t.id')
                        ->get();
                    
                    $conductorTurno->turnosAsignados = $turnosConductor;
                }

                //Diferencia kms en el mes
                $KMSTotales = $KM_Ultimo->TRN_AUT_Kilometraje_Turno - $KM_Anterior->KM_Anterior;
                $diferencia = $KMSTotales - $mensual->Kilometraje;
                
                if($diferencia > 0){
                    $mensual->Kilometraje = $KMSTotales;
                    $mensual->PromedioKilometraje = round($mensual->Producido / $mensual->Kilometraje);
                    $cadaConductor = round($diferencia/$conductores->count());
                    foreach ($conductores as $conductor) {
                        $conductor->Kilometraje = $conductor->Kilometraje + $cadaConductor;
                        $conductor->PromedioKilometraje = round($conductor->Producido / $conductor->Kilometraje);
                    }
                }

                $gastosAgregados = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', $fecha[1].'-'.$fecha[0].'-01')
                    ->get();
                
                foreach ($gastosAgregados as $gasto) {
                    if($gasto->GST_Costo_Gasto == -1){
                        $gasto->delete();
                        break;
                    }
                }

                $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', $fecha[1].'-'.$fecha[0].'-01')
                    ->select(
                        DB::raw('SUM(GST_Costo_Gasto) as GST_Costo_Gasto'),
                    )
                    ->first();

                if(!$gastos || !$gastos->GST_Costo_Gasto){
                    $gastos = Gastos::create([
                        'GST_Automovil_Id' => $automovil->id,
                        'GST_Mes_Anio_Gasto' => $fecha[1].'-'.$fecha[0].'-01',
                        'GST_Costo_Gasto' => -1
                    ]);
                }
                
                $ganancia = $mensual->Producido - ((!$gastos || $gastos->GST_Costo_Gasto < 0) ? 0 : $gastos->GST_Costo_Gasto);

                $propietarios = AutomovilPropietario::where('AUT_PRP_Automovil_Id', $automovil->id)
                    ->get()->count();

                $mensualDatos = Mensualidad::where('MNS_Automovil_Id', $automovil->id)
                    ->where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d'))
                    ->first();

                if(!$mensualDatos){
                    $mensualDatos = Mensualidad::create([
                        'MNS_Automovil_Id' => $automovil->id,
                        'MNS_Producido_Mensualidad' => $mensual->Producido,
                        'MNS_Gastos_Mensualidad' => $gastos->GST_Costo_Gasto,
                        'MNS_Kilometraje_Mensualidad' => $mensual->Kilometraje,
                        'MNS_Dias_Trabajados_Mensualidad' => $mensual->DiasTrabajados,
                        'MNS_Mes_Anio_Mensualidad' => Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d')
                    ]);
                } else {
                    $mensualDatos->update([
                        'MNS_Producido_Mensualidad' => $mensual->Producido,
                        'MNS_Kilometraje_Mensualidad' => $mensual->Kilometraje,
                        'MNS_Dias_Trabajados_Mensualidad' => $mensual->DiasTrabajados,
                        'MNS_Gastos_Mensualidad' => $gastos->GST_Costo_Gasto
                    ]);
                }
                if($gastos->GST_Costo_Gasto >= 0 && $mensualDatos->MNS_Gastos_Mensualidad == -1){
                    Mensualidad::where('MNS_Automovil_Id', $automovil->id)
                        ->where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d'))
                        ->update([
                            'MNS_Gastos_Mensualidad' => $gastos->GST_Costo_Gasto
                        ]);
                }
                
                return view(
                    'theme.back.automoviles.cuadro-mes', 
                    compact(
                        'automovil',
                        'mensual',
                        'conductores',
                        'gastos',
                        'fecha',
                        'ganancia',
                        'propietarios',
                        'KMSTotales'
                    )
                );
                //Fin Mensualidad
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function guardarGastos(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                if($request->ajax()){
                    if($request->Gastos == -1){
                        return response()->json(['mensaje' => 'noGastos']);
                    }
                    $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                        ->where('GST_Mes_Anio_Gasto', Carbon::createFromFormat('d-m-Y', '01-'.$request->MesAnio)->format('Y-m-d'))
                        ->first();
                    
                    if(!$gastos){
                        Gastos::create([
                            'GST_Automovil_Id' => $automovil->id,
                            'GST_Mes_Anio_Gasto' => Carbon::createFromFormat('d-m-Y', '01-'.$request->MesAnio)->format('Y-m-d'),
                            'GST_Costo_Gasto' => $request->Gastos
                        ]);
                    } else {
                        $gastos->update([
                            'GST_Costo_Gasto' => $request->Gastos
                        ]);
                    }
                    Mensualidad::where('MNS_Automovil_Id', $automovil->id)
                        ->where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('d-m-Y', '01-'.$request->MesAnio)->format('Y-m-d'))
                        ->first()->update([
                            'MNS_Gastos_Mensualidad' => $request->Gastos
                        ]);
                    
                    $propietarios = AutomovilPropietario::where('AUT_PRP_Automovil_Id', $automovil->id)
                        ->get()->count();
                    
                    return response()->json(['mensaje' => 'ok', 'propietarios' => $propietarios]);
                } else {
                    $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                        ->where('GST_Mes_Anio_Gasto', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnioGastos)->format('Y-m-d'))
                        ->get();
                    
                    foreach ($gastos as $gasto) {
                        if($gasto->GST_Costo_Gasto == -1){
                            $gasto->delete();
                            break;
                        }
                    }

                    Gastos::create([
                        'GST_Automovil_Id' => $automovil->id,
                        'GST_Mes_Anio_Gasto' => Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnioGastos)->format('Y-m-d'),
                        'GST_Descripcion_Gasto' => $request->GST_Descripcion_Gasto,
                        'GST_Costo_Gasto' => $request->GST_Costo_Gasto
                    ]);
                    Session::put(['FechaGastos' => $request->mesAnioGastos]);

                    return redirect()->route('agregar_gastos_sesion', ['id'=>Crypt::encrypt($automovil->id)])->with('mensaje', Lang::get('messages.ExpenseAdded'));
                }
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    private function obtenerConductoresFijos($fecha, $cantidadDias, $id){
        $conductoresFijos = DB::table('TBL_Usuario_Automovil_Turno as uat')
            ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
            ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
            ->where('uat.TRN_AUT_Automovil_Id', $id)
            ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
            ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
            ->select('u.*', DB::raw('COUNT(uat.TRN_AUT_Fecha_Turno) as turnos'))
            ->groupBy('u.id')
            ->limit(2);
        
        return $conductoresFijos;
    }

    private function obtenerDíasUnoQuince($fecha, $id){
        $diasUnoQuince = DB::table('TBL_Usuario_Automovil_Turno as uat')
            ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
            ->where('uat.TRN_AUT_Automovil_Id', $id)
            ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
            ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-15')
            ->select('uat.*', 'u.*')
            ->orderBy('uat.TRN_AUT_Fecha_Turno')
            ->groupBy('uat.TRN_AUT_Fecha_Turno')
            ->get();

        return $diasUnoQuince;
    }

    private function obtenerDíasDieciceisFin($fecha, $cantidadDias, $id){
        $diasDieciseisFin = DB::table('TBL_Usuario_Automovil_Turno as uat')
            ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
            ->where('uat.TRN_AUT_Automovil_Id', $id)
            ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-16')
            ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
            ->select('uat.*', 'u.*')
            ->orderBy('uat.TRN_AUT_Fecha_Turno')
            ->get();

        return $diasDieciseisFin;
    }

    public function balanceAnual(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $anio = ($request->Anio) ? $request->Anio : Carbon::now()->format('Y');

            if($automovil){
                $anual = DB::table('TBL_Mensualidad as m')
                    ->where('m.MNS_Automovil_Id', $automovil->id)
                    ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [Carbon::createFromFormat('d-m-Y', '01-01-'.$request->Anio)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', '31-12-'.$request->Anio)->format('Y-m-d')])
                    ->select(
                        'm.MNS_Producido_Mensualidad as Producido',
                        DB::raw("IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad) as Gastos"),
                        'm.MNS_Kilometraje_Mensualidad as Kilometraje',
                        'm.MNS_Dias_Trabajados_Mensualidad as DiasTrabajados',
                        DB::raw('ROUND(m.MNS_Producido_Mensualidad/m.MNS_Kilometraje_Mensualidad) as PromedioKilometraje'),
                        DB::raw('ROUND(m.MNS_Producido_Mensualidad/m.MNS_Dias_Trabajados_Mensualidad) as PromedioDia'),
                        'm.MNS_Mes_Anio_Mensualidad as MesAnio'
                    )
                    ->orderBy('MesAnio')
                    ->get();

                $totales = DB::table('TBL_Mensualidad as m')
                    ->where('m.MNS_Automovil_Id', $automovil->id)
                    ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [Carbon::createFromFormat('d-m-Y', '01-01-'.$request->Anio)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', '31-12-'.$request->Anio)->format('Y-m-d')])
                    ->select(
                        DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                        DB::raw('SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos'),
                        DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                        DB::raw('SUM(m.MNS_Dias_Trabajados_Mensualidad) as DiasTrabajados'),
                        DB::raw('ROUND(SUM(m.MNS_Producido_Mensualidad)/SUM(m.MNS_Kilometraje_Mensualidad)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(m.MNS_Producido_Mensualidad)/SUM(m.MNS_Dias_Trabajados_Mensualidad)) as PromedioDia')
                    )
                    ->groupBy('m.MNS_Automovil_Id')
                    ->first();
                
                $propietarios = AutomovilPropietario::where('AUT_PRP_Automovil_Id', $automovil->id)
                    ->get()->count();

                return view('theme.back.automoviles.anual', compact('automovil', 'anual', 'totales', 'propietarios', 'anio'));
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function balanceDiario(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                if(session()->get('Automovil_Id') == null || session()->get('Automovil_Id') != $automovil->id){
                    Session::put(['Automovil_Id' => $automovil->id]);
                }
                $fecha = explode("-", $request->mesAnioTurnos);
                $cantidadDias = $this->obtenerDiasMes($fecha[0], $fecha[1]);
                $cantidadFebrero = $this->obtenerDiasMes(02, $fecha[1]);

                $fechaMes = $request->mesAnioTurnos;
                //Conductores fijos
                $conductoresFijos = $this->obtenerConductoresFijos($fecha, $cantidadDias, $automovil->id)->orderBy('u.id')
                    ->get();
                    
                $conductorFijoUno = null;
                $conductorFijoDos = null;
                foreach ($conductoresFijos as $key => $conductor) {
                    $contador = $key+1;
                    $conductorFijoUno = ($conductoresFijos->count() <= $contador) ? $conductor : $conductoresFijos[$contador];
                    $conductorFijoDos = $conductor;
                    break;
                }
                
                $dias = [];
                for($i = 1; $i <= $cantidadDias; $i++){
                    $turnosDia = DB::table('TBL_Usuario_Automovil_Turno as uat')
                        ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                        ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                        ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                        ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$i)
                        ->select(
                            'u.USR_Nombres_Usuario',
                            'uat.TRN_AUT_Fecha_Turno',
                            'uat.TRN_AUT_Producido_Turno',
                            'uat.TRN_AUT_Kilometros_Andados_Turno',
                            'uat.TRN_AUT_Observacion_Turno_Seleccionado',
                            't.id as TurnoId'
                        )
                        ->orderBy('TRN_AUT_Fecha_Turno')
                        ->orderBy('u.USR_Nombres_Usuario')
                        ->get();
                    
                    array_push($dias, $turnosDia);
                }


                $mensual = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno)/2 as DiasTrabajados'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/(SUM(t.TRN_Valor_Turno)/2)) as PromedioDia')
                    )
                    ->groupBy('uat.TRN_AUT_Automovil_Id')
                    ->first();

                $KM_Anterior = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Dia%')
                    ->select(
                        DB::raw('(uat.TRN_AUT_Kilometraje_Turno - uat.TRN_AUT_Kilometros_Andados_Turno) as KM_Anterior')
                    )
                    ->first();
                
                $KM_Ultimo = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Noche%')
                    ->select(
                        'uat.TRN_AUT_Kilometraje_Turno'
                    )
                    ->first();
                
                //Diferencia kms en el mes
                $KMSTotales = ($KM_Ultimo) ? ($KM_Ultimo->TRN_AUT_Kilometraje_Turno - $KM_Anterior->KM_Anterior) : 0;
                $diferencia = $KMSTotales - (($mensual) ? $mensual->Kilometraje : 0);
                $cadaConductor = ($diferencia >= 0) ? ($diferencia / 2) : 0;
                
                $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnioTurnos)->format('Y-m-d'))
                    ->orderBy('id')
                    ->get();
                
                if($request->has('notificacion') && $request->notificacion == true){
                    Notificacion::find($request->notificacionId)->update([
                        'NTF_Visto_Notificacion' => 1
                    ]);
                }
                return view(
                    'theme.back.automoviles.cuadro-turno',
                    compact(
                        'automovil',
                        'conductorFijoUno',
                        'conductorFijoDos',
                        'dias',
                        'fechaMes',
                        'cantidadFebrero',
                        'cadaConductor',
                        'gastos'
                    )
                );
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function agregarGastos(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                if($request->has('notificacion') && $request->notificacion == true){
                    Notificacion::find($request->notificacionId)->update([
                        'NTF_Visto_Notificacion' => 1
                    ]);
                }

                $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', Carbon::createFromFormat('d-m-Y', '01-'.((sizeof($request->all()) <= 0) ? session()->get('FechaGastos') : $request->mesAnioGastos))->format('Y-m-d'))
                    ->get();
                
                $mesAnio = (sizeof($request->all()) <= 0) ? session()->get('FechaGastos') : $request->mesAnioGastos;

                return view('theme.back.automoviles.gastos.agregar', compact('gastos', 'mesAnio', 'automovil'));
            }

            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function pfdBalanceDiario(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                $fecha = explode("-", $request->mesAnioTurnos);
                $cantidadDias = $this->obtenerDiasMes($fecha[0], $fecha[1]);
                $cantidadFebrero = $this->obtenerDiasMes(02, $fecha[1]);

                $fechaMes = $request->mesAnioTurnos;
                //Conductores fijos
                $conductoresFijos = $this->obtenerConductoresFijos($fecha, $cantidadDias, $automovil->id)->orderBy('u.id')
                    ->get();
                    
                $conductorFijoUno = null;
                $conductorFijoDos = null;
                foreach ($conductoresFijos as $key => $conductor) {
                    $contador = $key+1;
                    $conductorFijoUno = ($conductoresFijos->count() <= $contador) ? $conductor : $conductoresFijos[$contador];
                    $conductorFijoDos = $conductor;
                    break;
                }
                
                $dias = [];
                for($i = 1; $i <= $cantidadDias; $i++){
                    $turnosDia = DB::table('TBL_Usuario_Automovil_Turno as uat')
                        ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                        ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                        ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                        ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$i)
                        ->select(
                            'u.USR_Nombres_Usuario',
                            'uat.TRN_AUT_Fecha_Turno',
                            'uat.TRN_AUT_Producido_Turno',
                            'uat.TRN_AUT_Kilometros_Andados_Turno',
                            'uat.TRN_AUT_Observacion_Turno_Seleccionado',
                            't.id as TurnoId'
                        )
                        ->orderBy('TRN_AUT_Fecha_Turno')
                        ->orderBy('u.USR_Nombres_Usuario')
                        ->get();
                    
                    array_push($dias, $turnosDia);
                }


                $mensual = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno)/2 as DiasTrabajados'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/(SUM(t.TRN_Valor_Turno)/2)) as PromedioDia')
                    )
                    ->groupBy('uat.TRN_AUT_Automovil_Id')
                    ->first();

                $KM_Anterior = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Dia%')
                    ->select(
                        DB::raw('(uat.TRN_AUT_Kilometraje_Turno - uat.TRN_AUT_Kilometros_Andados_Turno) as KM_Anterior')
                    )
                    ->first();
                
                $KM_Ultimo = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Noche%')
                    ->select(
                        'uat.TRN_AUT_Kilometraje_Turno'
                    )
                    ->first();
                
                //Diferencia kms en el mes
                $KMSTotales = ($KM_Ultimo) ? ($KM_Ultimo->TRN_AUT_Kilometraje_Turno - $KM_Anterior->KM_Anterior) : 0;
                $diferencia = $KMSTotales - (($mensual) ? $mensual->Kilometraje : 0);
                $cadaConductor = ($diferencia >= 0) ? ($diferencia / 2) : 0;
                
                $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnioTurnos)->format('Y-m-d'))
                    ->orderBy('id')
                    ->get();

                $utilitario = new Utility();
                $utilitario->festivos($fecha[1]);

                $pdf = PDF::loadView(
                    'theme.back.automoviles.pdf.cuadro-turnos',
                    compact(
                        'automovil',
                        'conductorFijoUno',
                        'conductorFijoDos',
                        'dias',
                        'fechaMes',
                        'cantidadFebrero',
                        'cadaConductor',
                        'gastos',
                        'KM_Anterior',
                        'utilitario'
                    )
                )->setPaper('legal', 'landscape');

                $fileName = 'CuadroDiario-'.Str::upper(Lang::get('messages.'.Carbon::parse('01-'.$fechaMes)->format('F')).' '.Carbon::parse('01-'.$fechaMes)->format('Y')).Lang::get('messages.Taxi').$automovil->AUT_Numero_Interno_Automovil;
        
                //return $pdf->stream($fileName.'.pdf');
                return $pdf->download($fileName.'.pdf');
                
                /*return view(
                    'theme.back.automoviles.pdf.cuadro-turnos',
                    compact(
                        'automovil',
                        'conductorFijoUno',
                        'conductorFijoDos',
                        'dias',
                        'fechaMes',
                        'cantidadFebrero',
                        'cadaConductor',
                        'gastos',
                        'KM_Anterior',
                        'utilitario'
                    )
                );*/
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function pfdBalanceMensual(Request $request, $id){
        try {

            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            if($automovil){
                //Mensualidad
                $fecha = explode("-", $request->mesAnio);
                $cantidadDias = $this->obtenerDiasMes($fecha[0], $fecha[1]);

                $mensual = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno)/2 as DiasTrabajados'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/(SUM(t.TRN_Valor_Turno)/2)) as PromedioDia')
                    )
                    ->groupBy('uat.TRN_AUT_Automovil_Id')
                    ->first();
                
                $KM_Anterior = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Dia%')
                    ->select(
                        DB::raw('(uat.TRN_AUT_Kilometraje_Turno - uat.TRN_AUT_Kilometros_Andados_Turno) as KM_Anterior')
                    )
                    ->first();
                
                $KM_Ultimo = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->where('t.TRN_Nombre_Turno', 'LIKE', '%Noche%')
                    ->select(
                        'uat.TRN_AUT_Kilometraje_Turno'
                    )
                    ->first();

                //Balance Trabajadores
                $conductores = DB::table('TBL_Usuario_Automovil_Turno as uat')
                    ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                    ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                    ->where('uat.TRN_AUT_Automovil_Id', $automovil->id)
                    ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                    ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                    ->select(
                        'u.id',
                        'u.USR_Nombres_Usuario',
                        DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido'),
                        DB::raw('SUM(uat.TRN_AUT_Kilometros_Andados_Turno) as Kilometraje'),
                        DB::raw('SUM(t.TRN_Valor_Turno) as Turnos'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(uat.TRN_AUT_Kilometros_Andados_Turno)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(uat.TRN_AUT_Producido_Turno)/SUM(t.TRN_Valor_Turno)) as PromedioTurno'),
                        DB::raw('null as turnosAsignados')
                    )
                    ->groupBy('u.id')
                    ->get();

                foreach ($conductores as $conductorTurno) {
                    $turnosConductor = DB::table('TBL_Usuario_Automovil_Turno as uat')
                        ->join('TBL_Usuario as u', 'u.id', 'uat.TRN_AUT_Usuario_Turno_Id')
                        ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                        ->where('TRN_AUT_Usuario_Turno_Id', $conductorTurno->id)
                        ->where('TRN_AUT_Fecha_Turno', '>=', $fecha[1].'-'.$fecha[0].'-01')
                        ->where('TRN_AUT_Fecha_Turno', '<=', $fecha[1].'-'.$fecha[0].'-'.$cantidadDias)
                        ->where(function($q) {
                            $q->where('t.TRN_Slug_Turno', 'dia')
                              ->orWhere('t.TRN_Slug_Turno', 'noche');
                        })
                        ->select('t.*')
                        ->groupBy('t.id')
                        ->get();
                    
                    $conductorTurno->turnosAsignados = $turnosConductor;
                }

                //Diferencia kms en el mes
                $KMSTotales = $KM_Ultimo->TRN_AUT_Kilometraje_Turno - $KM_Anterior->KM_Anterior;
                $diferencia = $KMSTotales - $mensual->Kilometraje;
                
                if($diferencia > 0){
                    $mensual->Kilometraje = $KMSTotales;
                    $mensual->PromedioKilometraje = round($mensual->Producido / $mensual->Kilometraje);
                    $cadaConductor = round($diferencia/$conductores->count());
                    foreach ($conductores as $conductor) {
                        $conductor->Kilometraje = $conductor->Kilometraje + $cadaConductor;
                        $conductor->PromedioKilometraje = round($conductor->Producido / $conductor->Kilometraje);
                    }
                }

                $gastosAgregados = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', $fecha[1].'-'.$fecha[0].'-01')
                    ->get();
                
                foreach ($gastosAgregados as $gasto) {
                    if($gasto->GST_Costo_Gasto == -1){
                        $gasto->delete();
                        break;
                    }
                }

                $gastos = Gastos::where('GST_Automovil_Id', $automovil->id)
                    ->where('GST_Mes_Anio_Gasto', $fecha[1].'-'.$fecha[0].'-01')
                    ->select(
                        DB::raw('SUM(GST_Costo_Gasto) as GST_Costo_Gasto'),
                    )
                    ->first();
                
                if(!$gastos){
                    $gastos = Gastos::create([
                        'GST_Automovil_Id' => $automovil->id,
                        'GST_Mes_Anio_Gasto' => $fecha[1].'-'.$fecha[0].'-01',
                        'GST_Costo_Gasto' => -1
                    ]);
                }
                
                $ganancia = $mensual->Producido - ((!$gastos || $gastos->GST_Costo_Gasto < 0) ? 0 : $gastos->GST_Costo_Gasto);

                $propietarios = AutomovilPropietario::where('AUT_PRP_Automovil_Id', $automovil->id)
                    ->get()->count();

                $mensualDatos = Mensualidad::where('MNS_Automovil_Id', $automovil->id)
                    ->where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d'))
                    ->first();

                if(!$mensualDatos){
                    Mensualidad::create([
                        'MNS_Automovil_Id' => $automovil->id,
                        'MNS_Producido_Mensualidad' => $mensual->Producido,
                        'MNS_Gastos_Mensualidad' => $gastos->GST_Costo_Gasto,
                        'MNS_Kilometraje_Mensualidad' => $mensual->Kilometraje,
                        'MNS_Dias_Trabajados_Mensualidad' => $mensual->DiasTrabajados,
                        'MNS_Mes_Anio_Mensualidad' => Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d')
                    ]);
                } else {
                    $mensualDatos->update([
                        'MNS_Producido_Mensualidad' => $mensual->Producido,
                        'MNS_Kilometraje_Mensualidad' => $mensual->Kilometraje,
                        'MNS_Dias_Trabajados_Mensualidad' => $mensual->DiasTrabajados
                    ]);
                }
                if($gastos->GST_Costo_Gasto >= 0 && $mensualDatos->MNS_Gastos_Mensualidad == -1){
                    Mensualidad::where('MNS_Automovil_Id', $automovil->id)
                        ->where('MNS_Mes_Anio_Mensualidad', Carbon::createFromFormat('d-m-Y', '01-'.$request->mesAnio)->format('Y-m-d'))
                        ->update([
                            'MNS_Gastos_Mensualidad' => $gastos->GST_Costo_Gasto
                        ]);
                }
                
                $pdf = PDF::loadView(
                    'theme.back.automoviles.pdf.cuadro-mes',
                    compact(
                        'automovil',
                        'mensual',
                        'conductores',
                        'gastos',
                        'fecha',
                        'ganancia',
                        'propietarios',
                        'KMSTotales'
                    )
                )->setPaper('legal', 'landscape');

                $fileName = 'CuadroMensual-'.Str::upper(Lang::get('messages.'.Carbon::parse('01-'.$fecha[0].'-'.$fecha[1])->format('F')).' '.Carbon::parse('01-'.$fecha[0].'-'.$fecha[1])->format('Y')).Lang::get('messages.Taxi').$automovil->AUT_Numero_Interno_Automovil;
        
                //return $pdf->stream($fileName.'.pdf');
                return $pdf->download($fileName.'.pdf');
                
                /*return view(
                    'theme.back.automoviles.pdf.cuadro-mes',
                    compact(
                        'automovil',
                        'mensual',
                        'conductores',
                        'gastos',
                        'fecha',
                        'ganancia',
                        'propietarios',
                        'KMSTotales'
                    )
                );*/
                //Fin Mensualidad
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    public function pdfBalanceAnual(Request $request, $id){
        try {
            $automovilId = Crypt::decrypt($id);
            $automovil = Automovil::findOrFail($automovilId);

            $anio = ($request->Anio) ? $request->Anio : Carbon::now()->format('Y');

            if($automovil){
                $anual = DB::table('TBL_Mensualidad as m')
                    ->where('m.MNS_Automovil_Id', $automovil->id)
                    ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [Carbon::createFromFormat('d-m-Y', '01-01-'.$request->Anio)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', '31-12-'.$request->Anio)->format('Y-m-d')])
                    ->select(
                        'm.MNS_Producido_Mensualidad as Producido',
                        DB::raw("IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad) as Gastos"),
                        'm.MNS_Kilometraje_Mensualidad as Kilometraje',
                        'm.MNS_Dias_Trabajados_Mensualidad as DiasTrabajados',
                        DB::raw('ROUND(m.MNS_Producido_Mensualidad/m.MNS_Kilometraje_Mensualidad) as PromedioKilometraje'),
                        DB::raw('ROUND(m.MNS_Producido_Mensualidad/m.MNS_Dias_Trabajados_Mensualidad) as PromedioDia'),
                        'm.MNS_Mes_Anio_Mensualidad as MesAnio'
                    )
                    ->orderBy('MesAnio')
                    ->get();

                $totales = DB::table('TBL_Mensualidad as m')
                    ->where('m.MNS_Automovil_Id', $automovil->id)
                    ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [Carbon::createFromFormat('d-m-Y', '01-01-'.$request->Anio)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', '31-12-'.$request->Anio)->format('Y-m-d')])
                    ->select(
                        DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                        DB::raw('SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos'),
                        DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                        DB::raw('SUM(m.MNS_Dias_Trabajados_Mensualidad) as DiasTrabajados'),
                        DB::raw('ROUND(SUM(m.MNS_Producido_Mensualidad)/SUM(m.MNS_Kilometraje_Mensualidad)) as PromedioKilometraje'),
                        DB::raw('ROUND(SUM(m.MNS_Producido_Mensualidad)/SUM(m.MNS_Dias_Trabajados_Mensualidad)) as PromedioDia')
                    )
                    ->groupBy('m.MNS_Automovil_Id')
                    ->first();
                
                $propietarios = AutomovilPropietario::where('AUT_PRP_Automovil_Id', $automovil->id)
                    ->get()->count();

                $pdf = PDF::loadView(
                    'theme.back.automoviles.pdf.cuadro-anual',
                    compact(
                        'automovil',
                        'anual',
                        'totales',
                        'propietarios',
                        'anio'
                    )
                )->setPaper('legal', 'landscape');

                $fileName = 'CuadroAnual-'.Str::upper(Carbon::parse('01-01-'.$anio)->format('Y')).Lang::get('messages.Taxi').$automovil->AUT_Numero_Interno_Automovil;
            
                //return $pdf->stream($fileName.'.pdf');
                return $pdf->download($fileName.'.pdf');
                    
                /*return view(
                    'theme.back.automoviles.pdf.cuadro-anual',
                    compact(
                        'automovil',
                        'anual',
                        'totales',
                        'propietarios',
                        'anio'
                    )
                );*/
            }
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.CarNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('automoviles')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }
}
