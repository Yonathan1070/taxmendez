<?php

namespace App\Providers;

use App\Models\Entity\Automovil;
use App\Models\Entity\Empresa;
use App\Models\Entity\Idioma;
use App\Models\Entity\Notificacion;
use App\Models\Entity\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        View::composer("theme.back.layout", function($view){
            $menus = DB::table('TBL_Permiso as p')
                ->join('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', '=', 'p.id')
                ->join('TBL_Usuario as u', 'u.id', '=', 'pu.PRM_USR_Usuario_Id')
                ->where('u.id', session()->get('Usuario_Id'))
                ->where('p.PRM_Menu_Permiso', 1)
                ->select('p.*')
                ->orderBy('p.PRM_Orden_Menu_Permiso')
                ->get()
                ->toArray();
            $view->with('menusComposer', $menus);
        });

        View::composer("theme.back.layout", function($view){
            $datosUsuario = Usuarios::findOrFail(session()->get('Usuario_Id'));
            $view->with('datosUsuario', $datosUsuario);
        });

        View::composer("theme.back.automoviles.meses", function($view){
            $mes = Carbon::now()->format('m');
            $anio = Carbon::now()->format('Y');

            $cantidadDias = $this->obtenerDiasMes($mes, $anio);

            $mesActual = DB::table('TBL_Usuario_Automovil_Turno as uat')
                ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                ->where('uat.TRN_AUT_Automovil_Id', session()->get('Automovil_Id'))
                ->whereBetween('uat.TRN_AUT_Fecha_Turno', [$anio.'-'.$mes.'-01', $anio.'-'.$mes.'-'.$cantidadDias])
                ->select(
                    DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido')
                )
                ->groupBy('uat.TRN_AUT_Automovil_Id')
                ->first();

            $mes = Carbon::now()->addMonths(-1)->format('m');
            $anio = Carbon::now()->addMonths(-1)->format('Y');
    
            $cantidadDias = $this->obtenerDiasMes($mes, $anio);

            $UnMesAntes = DB::table('TBL_Usuario_Automovil_Turno as uat')
                ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                ->where('uat.TRN_AUT_Automovil_Id', session()->get('Automovil_Id'))
                ->whereBetween('uat.TRN_AUT_Fecha_Turno', [$anio.'-'.$mes.'-01', $anio.'-'.$mes.'-'.$cantidadDias])
                ->select(
                    DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido')
                )
                ->groupBy('uat.TRN_AUT_Automovil_Id')
                ->first();

            $mes = Carbon::now()->addMonths(-2)->format('m');
            $anio = Carbon::now()->addMonths(-2)->format('Y');
    
            $cantidadDias = $this->obtenerDiasMes($mes, $anio);

            $DosMesesAntes = DB::table('TBL_Usuario_Automovil_Turno as uat')
                ->join('TBL_Turno as t', 't.id', 'uat.TRN_AUT_Turno_Id')
                ->where('uat.TRN_AUT_Automovil_Id', session()->get('Automovil_Id'))
                ->whereBetween('uat.TRN_AUT_Fecha_Turno', [$anio.'-'.$mes.'-01', $anio.'-'.$mes.'-'.$cantidadDias])
                ->select(
                    DB::raw('SUM(uat.TRN_AUT_Producido_Turno) as Producido')
                )
                ->groupBy('uat.TRN_AUT_Automovil_Id')
                ->first();
            $view->with('mesActual', $mesActual)
                ->with('unMesAntes', $UnMesAntes)
                ->with('dosMesesAntes', $DosMesesAntes);
        });

        View::composer("theme.back.top_header", function($view){
            if(session()->get('Rol_Nombre') == 'Super Administrador'){
                $automovilesFotos = Automovil::where('AUT_Foto_Automovil', '!=', null)->get();
            } else{
                $automovilesFotos = Automovil::where('AUT_Empresa_Id', session()->get('Empresa_Id'))
                    ->where('AUT_Foto_Automovil', '!=', null)->get();
            }
            $idiomas = Idioma::get();
            $empresa = Empresa::find(session()->get('Empresa_Id'));
            $canales = Usuarios::find(session()->get('Usuario_Id'))->canales;
            $notificaciones = Notificacion::where('NTF_Para_Notificacion', session()->get('Usuario_Id'))
                ->orderBy('created_at', 'desc')
                ->orderBy('NTF_Visto_Notificacion')
                ->orderBy('id')
                ->take(20)
                ->get();
            $notificaciones_no_vistas = Notificacion::where('NTF_Para_Notificacion', session()->get('Usuario_Id'))
                ->where('NTF_Visto_Notificacion', 0)
                ->get();
            $view->with('automovilesFotos', $automovilesFotos)
                ->with('idiomas', $idiomas)
                ->with('empresa', $empresa)
                ->with('canales', $canales)
                ->with('notificaciones', $notificaciones)
                ->with('notificaciones_no_vistas', $notificaciones_no_vistas);
        });

        //if(env('APP_ENV') !== 'local') { $url->forceScheme('https'); }
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
}
