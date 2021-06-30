<?php

namespace App\Http\Controllers;

use App\Models\Entity\CanalNotificacion;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class CanalNotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('canal_notificacion');

        $canales = CanalNotificacion::paginate(10);
        return view('theme.back.canal.listar', compact('canales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_canal_notificacion')){
                return view('theme.back.canal.crear');
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
            if(can2('crear_canal_notificacion')){
                DB::beginTransaction();
                $nick = Str::slug($request->CNT_Nombre_Canal_Notificacion, '_');
                $canal = CanalNotificacion::where('CNT_Nick_Canal_Notificacion', $nick)->first();

                if(!$canal){
                    $nuevoCanal = CanalNotificacion::crear($request, $nick);
                    if($nuevoCanal){
                        DB::commit();
                        return $this->vista(Lang::get('messages.NotificationChannelAdded'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.NotificationChannelExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('editar_canal_notificacion')){
                $canal = CanalNotificacion::find($id);
        
                if($canal){
                    return view('theme.back.canal.editar', compact('canal'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.ChannelNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('editar_canal_notificacion')){
                DB::beginTransaction();
                $canal = CanalNotificacion::find($id);
        
                if($canal){
                    $nick = Str::slug($request->CNT_Nombre_Canal_Notificacion, '_');
                    $canalDisctintId = CanalNotificacion::where('id', '!=', $id)
                        ->where('CNT_Nick_Canal_Notificacion', $nick)->first();
        
                    if(!$canalDisctintId){
                        $canalEditado = CanalNotificacion::editar($canal, $request, $nick);

                        if($canalEditado){
                            DB::commit();
                            return $this->vista(Lang::get('messages.NotificationChannelUpdated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                        }
                        DB::rollBack();
                    }
                    DB::rollBack();
                    return response()->json(['mensaje'=>Lang::get('messages.NotificationChannelExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.ChannelNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
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
            if(can2('eliminar_canal_notificacion')){
                DB::beginTransaction();
                
                if(CanalNotificacion::eliminar($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.DeletedChannelNotification'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.ChannelNotificationNotDelete'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        $canales = CanalNotificacion::paginate(10);
        return response()->json(['view'=>view('theme.back.canal.table-data')->with('canales', $canales)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $canales = CanalNotificacion::paginate(10);
            return view('theme.back.canal.table-data', compact('canales'))->render();
        }
    }
}
