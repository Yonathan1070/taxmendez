<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Entity\Automovil;
use App\Models\Entity\Mensualidad;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechaUnMes = Carbon::now()->addMonth(-1)->format('Y-m');
        $fechaDosMeses = Carbon::now()->addMonth(-2)->format('Y-m');
        $cantidadDiasUnMes = $this->obtenerDiasMes(Carbon::now()->addMonth(-1)->format('m'), Carbon::now()->addMonth(-1)->format('Y'));
        $cantidadDiasDosMeses = $this->obtenerDiasMes(Carbon::now()->addMonth(-2)->format('m'), Carbon::now()->addMonth(-2)->format('Y'));

        if(session()->get('Rol_Nombre') == "Super Administrador"){
            $generalUnMes = DB::table('TBL_Mensualidad as m')
                ->join('TBL_Automovil as a', 'a.id', 'm.MNS_Automovil_Id')
                ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [$fechaUnMes.'-01', $fechaUnMes.'-'.$cantidadDiasUnMes])
                ->select(
                    DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                    DB::raw("SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos"),
                    DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                    DB::raw('SUM(m.MNS_Producido_Mensualidad)-SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Ganancia'),
                )
                ->groupBy('a.AUT_Empresa_Id')
                ->first();

            $generalDosMeses = DB::table('TBL_Mensualidad as m')
                ->join('TBL_Automovil as a', 'a.id', 'm.MNS_Automovil_Id')
                ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [$fechaDosMeses.'-01', $fechaDosMeses.'-'.$cantidadDiasDosMeses])
                ->select(
                    DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                    DB::raw('SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos'),
                    DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                    DB::raw('SUM(m.MNS_Producido_Mensualidad)-SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Ganancia'),
                )
                ->groupBy('a.AUT_Empresa_Id')
                ->first();
        } else{
            $generalUnMes = DB::table('TBL_Mensualidad as m')
                ->join('TBL_Automovil as a', 'a.id', 'm.MNS_Automovil_Id')
                ->join('TBL_Automovil_Propietario as ap', 'ap.AUT_PRP_Automovil_Id', 'a.id')
                ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [$fechaUnMes.'-01', $fechaUnMes.'-'.$cantidadDiasUnMes])
                ->where('ap.AUT_PRP_Propietario_Id', session()->get('Usuario_Id'))
                ->select(
                    'a.AUT_Numero_Interno_Automovil',
                    DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                    DB::raw('SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos'),
                    DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                    DB::raw('SUM(m.MNS_Producido_Mensualidad)-SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Ganancia'),
                )
                ->groupBy('a.id')
                ->orderBy('a.AUT_Numero_Interno_Automovil')
                ->get();

            $generalDosMeses = DB::table('TBL_Mensualidad as m')
                ->join('TBL_Automovil as a', 'a.id', 'm.MNS_Automovil_Id')
                ->join('TBL_Automovil_Propietario as ap', 'ap.AUT_PRP_Automovil_Id', 'a.id')
                ->whereBetween('m.MNS_Mes_Anio_Mensualidad', [$fechaDosMeses.'-01', $fechaDosMeses.'-'.$cantidadDiasDosMeses])
                ->where('ap.AUT_PRP_Propietario_Id', session()->get('Usuario_Id'))
                ->select(
                    'a.AUT_Numero_Interno_Automovil',
                    DB::raw('SUM(m.MNS_Producido_Mensualidad) as Producido'),
                    DB::raw('SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Gastos'),
                    DB::raw('SUM(m.MNS_Kilometraje_Mensualidad) as Kilometraje'),
                    DB::raw('SUM(m.MNS_Producido_Mensualidad)-SUM(IF(m.MNS_Gastos_Mensualidad < 0, 0, m.MNS_Gastos_Mensualidad)) as Ganancia'),
                )
                ->groupBy('a.id')
                ->orderBy('a.AUT_Numero_Interno_Automovil')
                ->get()->toArray();
        }

        return view('theme.back.administracion.index', compact('generalUnMes', 'fechaUnMes', 'generalDosMeses', 'fechaDosMeses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datosMensuales(Request $request)
    {
        $from = Carbon::now()->addMonths(-12)->format('Y-m');
        $to = Carbon::now()->format('Y-m');
        
        $arrFecha = [];
        for($i=$from;$i<=$to;$i = date("Y-m", strtotime($i ."+ 1 month"))){
            $data = explode("-", $i);
            array_push($arrFecha, $data[1]."-".$data[0]);
        }

        $data = '';
        foreach ($arrFecha as $fecha) {
            $data .= "{ 'date':'".Carbon::parse('01-'.$fecha)->format('F-Y')."', ";
            $datos = DB::table('TBL_Mensualidad as m')
                ->rightJoin('TBL_Automovil as a', 'a.id', 'm.MNS_Automovil_Id')
                ->where('MNS_Mes_Anio_Mensualidad', $fecha)
                ->orderBy('a.AUT_Numero_Interno_Automovil')
                ->select(
                    'AUT_Numero_Interno_Automovil',
                    'MNS_Mes_Anio_Mensualidad',
                    DB::raw('ROUND((m.MNS_Gastos_Mensualidad/m.MNS_Producido_Mensualidad)*100) as procentaje')
                )
                ->get();
                
            foreach ($datos as $mes) {
                $data .= "'".$mes->AUT_Numero_Interno_Automovil."': '".$mes->procentaje."', ";
            }
            $data = substr($data, 0, -2);
            $data .= "}, ";
        }
        $data = substr($data, 0, -2);
            
        //$barColors = '';
        /*foreach ($datos as $dato) {
            $dato->barColors = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }*/
        
        $chart = [
            'data' => $data,
            'xkey' => 'date',
            'ykeys' => ['66', '68'],
            'labels' => ['66', '68'],
            'barColors' => [sprintf('#%06X', mt_rand(0, 0xFFFFFF)), sprintf('#%06X', mt_rand(0, 0xFFFFFF))]
        ];
        
        return $chart;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargarApp()
    {
        $fileName = 'TaxMobile.apk';
        $path = storage_path($fileName);
        $headers = array('Content-Type'=>'application/vnd.android.package-archive');

        return response()->download($path, $fileName, $headers);
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
