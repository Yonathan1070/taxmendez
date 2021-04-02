<?php

namespace App\Http\Controllers;

use App\Models\Entity\CanalNotificacion;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $canales = CanalNotificacion::get();
        return view('theme.back.canal.listar', compact('canales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.canal.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $nick = Str::slug($request->CNT_Nombre_Canal_Notificacion, '_');
        $canal = CanalNotificacion::where('CNT_Nick_Canal_Notificacion', $nick)->first();

        if($canal){
            return redirect()->route('crear_canal_notificacion')->withErrors(Lang::get('messages.NotificationChannelExists'))->withInput();
        }

        CanalNotificacion::create([
            'CNT_Nombre_Canal_Notificacion' => $request->CNT_Nombre_Canal_Notificacion,
            'CNT_Descripcion_Canal_Notificacion' => $request->CNT_Descripcion_Canal_Notificacion,
            'CNT_Nick_Canal_Notificacion' => $nick,
            'CNT_Habilitado_Canal_Notificacion' => $request->has('CNT_Habilitado_Canal_Notificacion')
        ]);

        return redirect()->route('crear_canal_notificacion')->with('mensaje', Lang::get('messages.NotificationChannelAdded'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('editar_canal_notificacion');
        try {
            $canalId = Crypt::decrypt($id);

            $canal = CanalNotificacion::find($canalId);
            
            if($canal){
                return view('theme.back.canal.editar', compact('canal'));
            }
            return redirect()->route('canal_notificacion')->with('mensaje', Lang::get('messages.ChannelNotExists'));

        } catch (DecryptException $e) {
            return redirect()->route('canal_notificacion')->withErrors(Lang::get('messages.IdNotValid'));
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
            $canalId = Crypt::decrypt($id);
            
            $canal = CanalNotificacion::find($canalId);

            if($canal){
                $nick = Str::slug($request->CNT_Nombre_Canal_Notificacion, '_');
                $canalDisctintId = CanalNotificacion::where('id', '!=', $canalId)
                    ->where('CNT_Nick_Canal_Notificacion', $nick)->first();

                if($canalDisctintId){
                    return redirect()->route('editar_canal_notificacion', ['id' => Crypt::encrypt($canal->id)])->withErrors(Lang::get('messages.NotificationChannelExists'))->withInput();
                }

                $canal->update([
                    'CNT_Nombre_Canal_Notificacion' => $request->CNT_Nombre_Canal_Notificacion,
                    'CNT_Descripcion_Canal_Notificacion' => $request->CNT_Descripcion_Canal_Notificacion,
                    'CNT_Nick_Canal_Notificacion' => $nick,
                    'CNT_Habilitado_Canal_Notificacion' => $request->has('CNT_Habilitado_Canal_Notificacion')
                ]);

                return redirect()->route('canal_notificacion')->with('mensaje', Lang::get('messages.NotificationChannelUpdated'));
            }
            return redirect()->route('canal_notificacion')->withErrors(Lang::get('messages.ChannelNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('canal_notificacion')->withErrors(Lang::get('messages.IdNotValid'));
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
