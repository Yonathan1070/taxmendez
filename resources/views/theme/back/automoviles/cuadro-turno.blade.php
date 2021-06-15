    <div class="card">
        <div class="card-body">
            <h4 class="card-title m-b-0">
                {{Lang::get('messages.Monthly')}} Taxi {{$automovil->AUT_Numero_Interno_Automovil}}   /   {{Lang::get('messages.'.Carbon\Carbon::parse('01-'.$fechaMes)->format('F')).' '.Carbon\Carbon::parse('01-'.$fechaMes)->format('Y')}}
            </h4>
            <?php 
                $mesMensualidad = str_split(Str::upper(Lang::get('messages.'.Carbon\Carbon::parse('01-'.$fechaMes)->format('F')).' '.Carbon\Carbon::parse('01-'.$fechaMes)->format('Y')));
                $totales = [];
            ?>
                    <div class="row">
                        <div class="col-12 m-t-30" style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
                            <div class="card-group">
                                <div class="col-md-12" style="padding-right: 0px; padding-left: 0px;">
                                    <div class="card">
                                            <div class="card-body" style="padding: 0;">
                                                <div class="table-responsive m-t-40">
                                                    <table style="width: 100%;" class="table-turnos">
                                                        <tbody>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Month')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">#</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.dia')}}</td>
                                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">#</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.dia')}}</td>
                                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                                <td colspan="2" rowspan="2" style="border:1px solid red;">GASTOS</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoUno) ? $conductorFijoUno->USR_Nombres_Usuario : '-'}}</td>
                                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoDos) ? $conductorFijoDos->USR_Nombres_Usuario : '-'}}</td>
                                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoUno) ? $conductorFijoUno->USR_Nombres_Usuario : '-'}}</td>
                                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoDos) ? $conductorFijoDos->USR_Nombres_Usuario : '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="34" style="font-size: 30px; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    @foreach ($mesMensualidad as $caracter)
                                                                        {{$caracter}}<br />
                                                                    @endforeach
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[0][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[0][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[0][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][0]->TurnoId != 1 && $dias[0][0]->TurnoId != 2) ? $dias[0][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[0][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][1]->TurnoId != 1 && $dias[0][1]->TurnoId != 2) ? $dias[0][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[15][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[15][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[15][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][0]->TurnoId != 1 && $dias[15][0]->TurnoId != 2) ? $dias[15][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[15][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][1]->TurnoId != 1 && $dias[15][1]->TurnoId != 2) ? $dias[15][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 0 && $gastos[0]) ? (($gastos[0]->GST_Descripcion_Gasto == null || $gastos[0]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[0]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 0 && $gastos[0]) ? ('$'.number_format(($gastos[0]->GST_Costo_Gasto < 0) ? 0 : $gastos[0]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : '$'.number_format($dias[0][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : $dias[0][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : '$'.number_format($dias[0][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[0]) == 0) ? '-' : $dias[0][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : '$'.number_format($dias[15][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : $dias[15][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : '$'.number_format($dias[15][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[15]) == 0) ? '-' : $dias[15][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 1 && $gastos[1]) ? (($gastos[1]->GST_Descripcion_Gasto == null || $gastos[1]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[1]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 1 && $gastos[1]) ? ('$'.number_format(($gastos[1]->GST_Costo_Gasto < 0) ? 0 : $gastos[1]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[1][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[1][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[1][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][0]->TurnoId != 1 && $dias[1][0]->TurnoId != 2) ? $dias[1][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[1][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][1]->TurnoId != 1 && $dias[1][1]->TurnoId != 2) ? $dias[1][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[16][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[16][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[16][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][0]->TurnoId != 1 && $dias[16][0]->TurnoId != 2) ? $dias[16][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[16][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][1]->TurnoId != 1 && $dias[16][1]->TurnoId != 2) ? $dias[16][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 2 && $gastos[2]) ? (($gastos[2]->GST_Descripcion_Gasto == null || $gastos[2]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[2]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 2 && $gastos[2]) ? ('$'.number_format(($gastos[1]->GST_Costo_Gasto < 0) ? 0 : $gastos[2]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : '$'.number_format($dias[1][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : $dias[1][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : '$'.number_format($dias[1][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[1]) == 0) ? '-' : $dias[1][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : '$'.number_format($dias[16][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : $dias[16][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : '$'.number_format($dias[16][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[16]) == 0) ? '-' : $dias[16][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 3 && $gastos[3]) ? (($gastos[3]->GST_Descripcion_Gasto == null || $gastos[3]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[3]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 3 && $gastos[3]) ? ('$'.number_format(($gastos[3]->GST_Costo_Gasto < 0) ? 0 : $gastos[3]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[2][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[2][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[2][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][0]->TurnoId != 1 && $dias[2][0]->TurnoId != 2) ? $dias[2][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[2][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][1]->TurnoId != 1 && $dias[2][1]->TurnoId != 2) ? $dias[2][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[17][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[17][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[17][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][0]->TurnoId != 1 && $dias[17][0]->TurnoId != 2) ? $dias[17][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[17][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][1]->TurnoId != 1 && $dias[17][1]->TurnoId != 2) ? $dias[17][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 4 && $gastos[4]) ? (($gastos[4]->GST_Descripcion_Gasto == null || $gastos[1]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[4]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 4 && $gastos[4]) ? ('$'.number_format(($gastos[4]->GST_Costo_Gasto < 0) ? 0 : $gastos[4]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : '$'.number_format($dias[2][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : $dias[2][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : '$'.number_format($dias[2][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[2]) == 0) ? '-' : $dias[2][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : '$'.number_format($dias[17][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : $dias[17][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : '$'.number_format($dias[17][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[17]) == 0) ? '-' : $dias[17][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 5 && $gastos[5]) ? (($gastos[5]->GST_Descripcion_Gasto == null || $gastos[5]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[5]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 5 && $gastos[5]) ? ('$'.number_format(($gastos[5]->GST_Costo_Gasto < 0) ? 0 : $gastos[5]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[3][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[3][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[3][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][0]->TurnoId != 1 && $dias[3][0]->TurnoId != 2) ? $dias[3][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[3][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][1]->TurnoId != 1 && $dias[3][1]->TurnoId != 2) ? $dias[3][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[18][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[18][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[18][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][0]->TurnoId != 1 && $dias[18][0]->TurnoId != 2) ? $dias[18][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[18][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][1]->TurnoId != 1 && $dias[18][1]->TurnoId != 2) ? $dias[18][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 6 && $gastos[6]) ? (($gastos[6]->GST_Descripcion_Gasto == null || $gastos[6]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[6]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 6 && $gastos[6]) ? ('$'.number_format(($gastos[6]->GST_Costo_Gasto < 0) ? 0 : $gastos[6]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : '$'.number_format($dias[3][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : $dias[3][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : '$'.number_format($dias[3][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[3]) == 0) ? '-' : $dias[3][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : '$'.number_format($dias[18][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : $dias[18][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : '$'.number_format($dias[18][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[18]) == 0) ? '-' : $dias[18][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 7 && $gastos[7]) ? (($gastos[7]->GST_Descripcion_Gasto == null || $gastos[7]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[7]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 7 && $gastos[7]) ? ('$'.number_format(($gastos[7]->GST_Costo_Gasto < 0) ? 0 : $gastos[7]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[4][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[4][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[4][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][0]->TurnoId != 1 && $dias[4][0]->TurnoId != 2) ? $dias[4][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[4][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][1]->TurnoId != 1 && $dias[4][1]->TurnoId != 2) ? $dias[4][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[19][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[19][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[19][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][0]->TurnoId != 1 && $dias[19][0]->TurnoId != 2) ? $dias[19][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[19][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][1]->TurnoId != 1 && $dias[19][1]->TurnoId != 2) ? $dias[19][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 8 && $gastos[8]) ? (($gastos[8]->GST_Descripcion_Gasto == null || $gastos[8]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[8]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 8 && $gastos[8]) ? ('$'.number_format(($gastos[8]->GST_Costo_Gasto < 0) ? 0 : $gastos[8]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : '$'.number_format($dias[4][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : $dias[4][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : '$'.number_format($dias[4][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[4]) == 0) ? '-' : $dias[4][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : '$'.number_format($dias[19][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : $dias[19][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : '$'.number_format($dias[19][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[19]) == 0) ? '-' : $dias[19][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 9 && $gastos[9]) ? (($gastos[9]->GST_Descripcion_Gasto == null || $gastos[9]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[9]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 9 && $gastos[9]) ? ('$'.number_format(($gastos[9]->GST_Costo_Gasto < 0) ? 0 : $gastos[9]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[5][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[5][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[5][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][0]->TurnoId != 1 && $dias[5][0]->TurnoId != 2) ? $dias[5][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[5][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][1]->TurnoId != 1 && $dias[5][1]->TurnoId != 2) ? $dias[5][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[20][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[20][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[20][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][0]->TurnoId != 1 && $dias[20][0]->TurnoId != 2) ? $dias[20][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[20][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][1]->TurnoId != 1 && $dias[20][1]->TurnoId != 2) ? $dias[20][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 10 && $gastos[10]) ? (($gastos[10]->GST_Descripcion_Gasto == null || $gastos[10]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[10]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 10 && $gastos[10]) ? ('$'.number_format(($gastos[10]->GST_Costo_Gasto < 0) ? 0 : $gastos[10]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : '$'.number_format($dias[5][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : $dias[5][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : '$'.number_format($dias[5][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[5]) == 0) ? '-' : $dias[5][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : '$'.number_format($dias[20][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : $dias[20][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : '$'.number_format($dias[20][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[20]) == 0) ? '-' : $dias[20][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 11 && $gastos[11]) ? (($gastos[11]->GST_Descripcion_Gasto == null || $gastos[11]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[11]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 11 && $gastos[11]) ? ('$'.number_format(($gastos[11]->GST_Costo_Gasto < 0) ? 0 : $gastos[11]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[6][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[6][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[6][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][0]->TurnoId != 1 && $dias[6][0]->TurnoId != 2) ? $dias[6][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[6][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][1]->TurnoId != 1 && $dias[6][1]->TurnoId != 2) ? $dias[6][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[21][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[21][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[21][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][0]->TurnoId != 1 && $dias[21][0]->TurnoId != 2) ? $dias[21][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[21][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][1]->TurnoId != 1 && $dias[21][1]->TurnoId != 2) ? $dias[21][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 12 && $gastos[12]) ? (($gastos[12]->GST_Descripcion_Gasto == null || $gastos[12]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[12]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 12 && $gastos[12]) ? ('$'.number_format(($gastos[12]->GST_Costo_Gasto < 0) ? 0 : $gastos[12]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : '$'.number_format($dias[6][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : $dias[6][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : '$'.number_format($dias[6][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[6]) == 0) ? '-' : $dias[6][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : '$'.number_format($dias[21][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : $dias[21][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : '$'.number_format($dias[21][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[21]) == 0) ? '-' : $dias[21][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 13 && $gastos[13]) ? (($gastos[13]->GST_Descripcion_Gasto == null || $gastos[13]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[13]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 13 && $gastos[13]) ? ('$'.number_format(($gastos[13]->GST_Costo_Gasto < 0) ? 0 : $gastos[13]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[7][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[7][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[7][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][0]->TurnoId != 1 && $dias[7][0]->TurnoId != 2) ? $dias[7][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[7][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][1]->TurnoId != 1 && $dias[7][1]->TurnoId != 2) ? $dias[7][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[22][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[22][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[22][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][0]->TurnoId != 1 && $dias[22][0]->TurnoId != 2) ? $dias[22][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[22][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][1]->TurnoId != 1 && $dias[22][1]->TurnoId != 2) ? $dias[22][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 14 && $gastos[14]) ? (($gastos[14]->GST_Descripcion_Gasto == null || $gastos[14]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[14]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 14 && $gastos[14]) ? ('$'.number_format(($gastos[14]->GST_Costo_Gasto < 0) ? 0 : $gastos[14]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : '$'.number_format($dias[7][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : $dias[7][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : '$'.number_format($dias[7][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[7]) == 0) ? '-' : $dias[7][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : '$'.number_format($dias[22][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : $dias[22][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : '$'.number_format($dias[22][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[22]) == 0) ? '-' : $dias[22][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 15 && $gastos[15]) ? (($gastos[15]->GST_Descripcion_Gasto == null || $gastos[15]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[15]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 15 && $gastos[15]) ? ('$'.number_format(($gastos[15]->GST_Costo_Gasto < 0) ? 0 : $gastos[15]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[8][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[8][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[8][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][0]->TurnoId != 1 && $dias[8][0]->TurnoId != 2) ? $dias[8][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[8][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][1]->TurnoId != 1 && $dias[8][1]->TurnoId != 2) ? $dias[8][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[23][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[23][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[23][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][0]->TurnoId != 1 && $dias[23][0]->TurnoId != 2) ? $dias[23][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[23][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][1]->TurnoId != 1 && $dias[23][1]->TurnoId != 2) ? $dias[23][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 16 && $gastos[16]) ? (($gastos[16]->GST_Descripcion_Gasto == null || $gastos[16]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[16]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 16 && $gastos[16]) ? ('$'.number_format(($gastos[16]->GST_Costo_Gasto < 0) ? 0 : $gastos[16]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : '$'.number_format($dias[8][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : $dias[8][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : '$'.number_format($dias[8][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[8]) == 0) ? '-' : $dias[8][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : '$'.number_format($dias[23][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : $dias[23][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : '$'.number_format($dias[23][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[23]) == 0) ? '-' : $dias[23][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 17 && $gastos[17]) ? (($gastos[17]->GST_Descripcion_Gasto == null || $gastos[17]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[17]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 17 && $gastos[17]) ? ('$'.number_format(($gastos[17]->GST_Costo_Gasto < 0) ? 0 : $gastos[17]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[9][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[9][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[9][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][0]->TurnoId != 1 && $dias[9][0]->TurnoId != 2) ? $dias[9][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[9][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][1]->TurnoId != 1 && $dias[9][1]->TurnoId != 2) ? $dias[9][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[24][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[24][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[24][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][0]->TurnoId != 1 && $dias[24][0]->TurnoId != 2) ? $dias[24][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[24][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][1]->TurnoId != 1 && $dias[24][1]->TurnoId != 2) ? $dias[24][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 18 && $gastos[18]) ? (($gastos[18]->GST_Descripcion_Gasto == null || $gastos[18]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[18]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 18 && $gastos[18]) ? ('$'.number_format(($gastos[18]->GST_Costo_Gasto < 0) ? 0 : $gastos[18]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : '$'.number_format($dias[9][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : $dias[9][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : '$'.number_format($dias[9][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[9]) == 0) ? '-' : $dias[9][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : '$'.number_format($dias[24][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : $dias[24][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : '$'.number_format($dias[24][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[24]) == 0) ? '-' : $dias[24][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 19 && $gastos[19]) ? (($gastos[19]->GST_Descripcion_Gasto == null || $gastos[19]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[19]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 19 && $gastos[19]) ? ('$'.number_format(($gastos[19]->GST_Costo_Gasto < 0) ? 0 : $gastos[19]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[10][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[10][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[10][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][0]->TurnoId != 1 && $dias[10][0]->TurnoId != 2) ? $dias[10][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[10][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][1]->TurnoId != 1 && $dias[10][1]->TurnoId != 2) ? $dias[10][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[25][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[25][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[25][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][0]->TurnoId != 1 && $dias[25][0]->TurnoId != 2) ? $dias[25][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[25][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][1]->TurnoId != 1 && $dias[25][1]->TurnoId != 2) ? $dias[25][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 20 && $gastos[20]) ? (($gastos[20]->GST_Descripcion_Gasto == null || $gastos[20]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[20]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 20 && $gastos[20]) ? ('$'.number_format(($gastos[20]->GST_Costo_Gasto < 0) ? 0 : $gastos[20]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : '$'.number_format($dias[10][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : $dias[10][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : '$'.number_format($dias[10][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[10]) == 0) ? '-' : $dias[10][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : '$'.number_format($dias[25][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : $dias[25][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : '$'.number_format($dias[25][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[25]) == 0) ? '-' : $dias[25][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 21 && $gastos[21]) ? (($gastos[21]->GST_Descripcion_Gasto == null || $gastos[21]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[21]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 21 && $gastos[21]) ? ('$'.number_format(($gastos[21]->GST_Costo_Gasto < 0) ? 0 : $gastos[21]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[11][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[11][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[11][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][0]->TurnoId != 1 && $dias[11][0]->TurnoId != 2) ? $dias[11][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[11][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][1]->TurnoId != 1 && $dias[11][1]->TurnoId != 2) ? $dias[11][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[26][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[26][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[26][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][0]->TurnoId != 1 && $dias[26][0]->TurnoId != 2) ? $dias[26][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[26][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][1]->TurnoId != 1 && $dias[26][1]->TurnoId != 2) ? $dias[26][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 22 && $gastos[22]) ? (($gastos[22]->GST_Descripcion_Gasto == null || $gastos[22]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[22]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 22 && $gastos[22]) ? ('$'.number_format(($gastos[22]->GST_Costo_Gasto < 0) ? 0 : $gastos[22]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : '$'.number_format($dias[11][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : $dias[11][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : '$'.number_format($dias[11][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[11]) == 0) ? '-' : $dias[11][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : '$'.number_format($dias[26][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : $dias[26][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : '$'.number_format($dias[26][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[26]) == 0) ? '-' : $dias[26][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 23 && $gastos[23]) ? (($gastos[23]->GST_Descripcion_Gasto == null || $gastos[23]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[23]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 23 && $gastos[23]) ? ('$'.number_format(($gastos[23]->GST_Costo_Gasto < 0) ? 0 : $gastos[23]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[12][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[12][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[12][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][0]->TurnoId != 1 && $dias[12][0]->TurnoId != 2) ? $dias[12][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[12][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][1]->TurnoId != 1 && $dias[12][1]->TurnoId != 2) ? $dias[12][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[27][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[27][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[27][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][0]->TurnoId != 1 && $dias[27][0]->TurnoId != 2) ? $dias[27][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[27][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][1]->TurnoId != 1 && $dias[27][1]->TurnoId != 2) ? $dias[27][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 24 && $gastos[24]) ? (($gastos[24]->GST_Descripcion_Gasto == null || $gastos[24]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[24]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 24 && $gastos[24]) ? ('$'.number_format(($gastos[24]->GST_Costo_Gasto < 0) ? 0 : $gastos[24]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : '$'.number_format($dias[12][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : $dias[12][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : '$'.number_format($dias[12][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[12]) == 0) ? '-' : $dias[12][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : '$'.number_format($dias[27][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : $dias[27][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : '$'.number_format($dias[27][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[27]) == 0) ? '-' : $dias[27][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 25 && $gastos[25]) ? (($gastos[25]->GST_Descripcion_Gasto == null || $gastos[25]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[25]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 25 && $gastos[25]) ? ('$'.number_format(($gastos[25]->GST_Costo_Gasto < 0) ? 0 : $gastos[25]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[13][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[13][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[13][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][0]->TurnoId != 1 && $dias[13][0]->TurnoId != 2) ? $dias[13][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[13][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][1]->TurnoId != 1 && $dias[13][1]->TurnoId != 2) ? $dias[13][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[28][0]->TRN_AUT_Fecha_Turno)->format('d')) : ''}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[28][0]->TRN_AUT_Fecha_Turno)->format('l'))) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : (($dias[28][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[28][0]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : (($dias[28][0]->TurnoId != 1 && $dias[28][0]->TurnoId != 2) ? $dias[28][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : (($dias[28][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[28][1]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : (($dias[28][1]->TurnoId != 1 && $dias[28][1]->TurnoId != 2) ? $dias[28][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 26 && $gastos[26]) ? (($gastos[26]->GST_Descripcion_Gasto == null || $gastos[26]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[26]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 26 && $gastos[26]) ? ('$'.number_format(($gastos[26]->GST_Costo_Gasto < 0) ? 0 : $gastos[26]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : '$'.number_format($dias[13][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : $dias[13][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : '$'.number_format($dias[13][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[13]) == 0) ? '-' : $dias[13][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : '$'.number_format($dias[28][0]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : $dias[28][0]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : '$'.number_format($dias[28][1]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[28]) == 0) ? '-' : $dias[28][1]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 27 && $gastos[27]) ? (($gastos[27]->GST_Descripcion_Gasto == null || $gastos[27]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[27]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 27 && $gastos[27]) ? ('$'.number_format(($gastos[27]->GST_Costo_Gasto < 0) ? 0 : $gastos[27]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[14][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[14][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[14][0]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][0]->TurnoId != 1 && $dias[14][0]->TurnoId != 2) ? $dias[14][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[14][1]->USR_Nombres_Usuario)}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][1]->TurnoId != 1 && $dias[14][1]->TurnoId != 2) ? $dias[14][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[29][0]->TRN_AUT_Fecha_Turno)->format('d')) : ''}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[29][0]->TRN_AUT_Fecha_Turno)->format('l'))) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : (($dias[29][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[29][0]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : (($dias[29][0]->TurnoId != 1 && $dias[29][0]->TurnoId != 2) ? $dias[29][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : (($dias[29][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[29][1]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : (($dias[29][1]->TurnoId != 1 && $dias[29][1]->TurnoId != 2) ? $dias[29][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 28 && $gastos[28]) ? (($gastos[28]->GST_Descripcion_Gasto == null || $gastos[28]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[28]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 28 && $gastos[28]) ? ('$'.number_format(($gastos[28]->GST_Costo_Gasto < 0) ? 0 : $gastos[28]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : '$'.number_format($dias[14][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : $dias[14][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : '$'.number_format($dias[14][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias[14]) == 0) ? '-' : $dias[14][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : '$'.number_format($dias[29][0]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : $dias[29][0]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : '$'.number_format($dias[29][1]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero) ? ((sizeof($dias[29]) == 0) ? '-' : $dias[29][1]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 29 && $gastos[29]) ? (($gastos[29]->GST_Descripcion_Gasto == null || $gastos[29]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[29]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 29 && $gastos[29]) ? ('$'.number_format(($gastos[29]->GST_Costo_Gasto < 0) ? 0 : $gastos[29]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td rowspan="4" style="border:1px solid red; border-top:0; border-bottom: 0;"></td>
                                                                <td rowspan="4" style="border:1px solid red; border-top:0; border-bottom: 0;"></td>
                                                                <td rowspan="4" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        '$'.number_format(
                                                                            (
                                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][0]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][0]->TRN_AUT_Producido_Turno))
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td rowspan="4" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        number_format(
                                                                            (
                                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][0]->TRN_AUT_Kilometros_Andados_Turno))
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td rowspan="4" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        '$'.number_format(
                                                                            (
                                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][1]->TRN_AUT_Producido_Turno) + 
                                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][1]->TRN_AUT_Producido_Turno))
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td rowspan="4" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        number_format(
                                                                            (
                                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][1]->TRN_AUT_Kilometros_Andados_Turno))
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[30][0]->TRN_AUT_Fecha_Turno)->format('d')) : ''}}
                                                                </td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[30][0]->TRN_AUT_Fecha_Turno)->format('l'))) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : (($dias[30][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[30][0]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : (($dias[30][0]->TurnoId != 1 && $dias[30][0]->TurnoId != 2) ? $dias[30][0]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : (($dias[30][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[30][1]->USR_Nombres_Usuario)) : ''}}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0; font-size: 10px;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : (($dias[30][1]->TurnoId != 1 && $dias[30][1]->TurnoId != 2) ? $dias[30][1]->TRN_AUT_Observacion_Turno_Seleccionado : '-')) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 30 && $gastos[30]) ? (($gastos[30]->GST_Descripcion_Gasto == null || $gastos[30]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[30]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 30 && $gastos[30]) ? ('$'.number_format(($gastos[30]->GST_Costo_Gasto < 0) ? 0 : $gastos[30]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : '$'.number_format($dias[30][0]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : $dias[30][0]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : '$'.number_format($dias[30][1]->TRN_AUT_Producido_Turno, 0, ',', '.')) : ''}}
                                                                </td>
                                                                <td style="border:1px solid red; border-top:0; border-bottom: 1px solid #99abb4;">
                                                                    {{(sizeof($dias) > $cantidadFebrero && sizeof($dias) > 30) ? ((sizeof($dias[30]) == 0) ? '-' : $dias[30][1]->TRN_AUT_Kilometros_Andados_Turno) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 31 && $gastos[31]) ? (($gastos[31]->GST_Descripcion_Gasto == null || $gastos[31]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[31]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 31 && $gastos[31]) ? ('$'.number_format(($gastos[31]->GST_Costo_Gasto < 0) ? 0 : $gastos[31]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 0;"></td>
                                                                <td rowspan="2" style="border:1px solid red; border-top:0; border-bottom: 0;"></td>
                                                                <td rowspan="2" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        '$'.number_format(
                                                                            (
                                                                                (
                                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][0]->TRN_AUT_Producido_Turno) +
                                                                                    (
                                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][0]->TRN_AUT_Producido_Turno) +
                                                                                            ((sizeof($dias[29]) == 0) ? 0 : $dias[29][0]->TRN_AUT_Producido_Turno) + 
                                                                                            ((sizeof($dias) > 30) ? (((sizeof($dias[30]) == 0) ? 0 : $dias[30][0]->TRN_AUT_Producido_Turno)) : 0)
                                                                                        ) : 0
                                                                                    )
                                                                                )
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">{{($cadaConductor == 0) ? '-' : $cadaConductor}}</td>
                                                                <td rowspan="2" style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        '$'.number_format(
                                                                            (
                                                                                (
                                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][1]->TRN_AUT_Producido_Turno) +
                                                                                    (
                                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][1]->TRN_AUT_Producido_Turno) +
                                                                                            ((sizeof($dias[29]) == 0) ? 0 : $dias[29][1]->TRN_AUT_Producido_Turno) + 
                                                                                            ((sizeof($dias) > 30) ? (((sizeof($dias[30]) == 0) ? 0 : $dias[30][1]->TRN_AUT_Producido_Turno)) : 0)
                                                                                        ) : 0
                                                                                    )
                                                                                )
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td style="color: red; border:1px solid red; border-top:0; border-bottom: 0;">{{($cadaConductor == 0) ? '-' : $cadaConductor}}</td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 32 && $gastos[32]) ? (($gastos[32]->GST_Descripcion_Gasto == null || $gastos[32]->GST_Descripcion_Gasto == '') ? Lang::get('messages.GeneralExpenses') : $gastos[32]->GST_Descripcion_Gasto) : ''}}
                                                                </td>
                                                                <td>
                                                                    {{(sizeof($gastos) > 32 && $gastos[32]) ? ('$'.number_format(($gastos[32]->GST_Costo_Gasto < 0) ? 0 : $gastos[32]->GST_Costo_Gasto, 0, ',', '.')) : ''}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        number_format(
                                                                            (
                                                                                (
                                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][0]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                                    (
                                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][0]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                                            ((sizeof($dias[29]) == 0) ? 0 : $dias[29][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                            ((sizeof($dias) > 30) ? (((sizeof($dias[30]) == 0) ? 0 : $dias[30][0]->TRN_AUT_Kilometros_Andados_Turno)) : 0)
                                                                                        ) : 0
                                                                                    )
                                                                                ) + (($cadaConductor == 0) ? 0 : $cadaConductor)
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td style="border:1px solid red; border-bottom:0;">
                                                                    {{
                                                                        number_format(
                                                                            (
                                                                                (
                                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][1]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                                    (
                                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][1]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                                            ((sizeof($dias[29]) == 0) ? 0 : $dias[29][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                            ((sizeof($dias) > 30) ? (((sizeof($dias[30]) == 0) ? 0 : $dias[30][1]->TRN_AUT_Kilometros_Andados_Turno)) : 0)
                                                                                        ) : 0
                                                                                    ) + (($cadaConductor == 0) ? 0 : $cadaConductor)
                                                                                )
                                                                            ),
                                                                            0,
                                                                            ',',
                                                                            '.'
                                                                        )
                                                                    }}
                                                                </td>
                                                                <td colspan="2" style="border:1px solid red; border-bottom:0;">
                                                                    <?php $totalGastos = 0 ?>
                                                                    @foreach ($gastos as $item)
                                                                        <?php $totalGastos = $totalGastos + $item->GST_Costo_Gasto ?>
                                                                    @endforeach
                                                                    {{'$ '.number_format(($totalGastos < 0) ? 0 : $totalGastos, 0, ',', '.')}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <div class="row">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                                <form action="{{route('balance_diario_pdf', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                                    @csrf
                                    <input name="mesAnioTurnos" id="mesAnioTurnos" type="hidden" value="{{$fechaMes}}">
                                    <button type="submit" id="turnos" class="btn btn-block btn-success">{{Lang::get('messages.PdfGenerate')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
    </div>