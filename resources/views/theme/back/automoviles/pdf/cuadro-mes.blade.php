<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin-bottom: 0px; margin-top: 0px; }
        body { margin-bottom: 0px; margin-top: 0px; }
    </style>
</head>
<body>
    <center>
        <table style="width: 100%; text-align:center;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 11%"></td>
                    <td style="width: 11%"><h3 style="margin-bottom: 0px; color: red;">{{Lang::get('messages.Taxi')}}</h3></td>
                    <td style="width: 11%"></td>
                    <td style="width: 11%"><h3 style="margin-bottom: 0px; color: red;">{{$automovil->AUT_Numero_Interno_Automovil}}</h3></td>
                    <td style="width: 11%"></td>
                    <td style="width: 11%"><h3 style="margin-bottom: 0px; color: red;">{{Str::upper(Lang::get('messages.'.Carbon\Carbon::parse('01-'.$fecha[0].'-'.$fecha[1])->format('F')))}}</h3></td>
                    <td style="width: 11%"></td>
                    <td style="width: 11%"><h3 style="margin-bottom: 0px; color: red;">{{Str::upper(Carbon\Carbon::parse('01-'.$fecha[0].'-'.$fecha[1])->format('Y'))}}</h3></td>
                    <td style="width: 11%"></td>
                </tr>
            </tbody>
        </table>
        <br/>
        <table style="width: 100%; text-align:center;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 12%;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Produced')}}
                        </h3>
                    </td>
                    <td style="width: 12%;">
                        <h3 style="margin-bottom: 0px;">
                            {{'$ '.number_format($mensual->Producido, 2, ',', '.')}}
                        </h3>
                    </td>
                    <td style="width: 12%;"></td>
                    <td style="width: 12%;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Mileage')}}
                        </h3>
                    </td>
                    <td style="width: 12%;">
                        <h3 style="margin-bottom: 0px;">
                            {{$mensual->Kilometraje}}
                        </h3>
                    </td>
                    <td style="width: 12%;"></td>
                    <td style="width: 14%;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.WorkedDays')}}
                        </h3>
                    </td>
                    <td style="width: 14%;">
                        <h3 style="margin-bottom: 0px;">
                            {{$mensual->DiasTrabajados}}
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; text-align:center;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 25%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.AverageDay')}}
                        </h3>
                    </td>
                    <td style="width: 15%;">
                        <h3 style="margin-bottom: 0px;">
                            {{'$ '.number_format($mensual->PromedioDia, 2, ',', '.')}}
                        </h3>
                    </td>
                    <td style="width: 10%;"></td>
                    <td style="width: 30%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.AveragePerMileage')}}
                        </h3>
                    </td>
                    <td style="width: 20%;">
                        <h3 style="margin-bottom: 0px;">
                            {{$mensual->PromedioKilometraje}}
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <br/>
        <table style="width: 100%; text-align:center;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 14%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Driver')}}
                        </h3>
                    </td>
                    <td style="width: 14%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Produced')}}
                        </h3>
                    </td>
                    <td style="width: 14%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Mileage')}}
                        </h3>
                    </td>
                    <td style="width: 14%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Turns')}}
                        </h3>
                    </td>
                    <td style="width: 17%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.AverageMileage')}}
                        </h3>
                    </td>
                    <td style="width: 17%; color: red;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.AverageTurn')}}
                        </h3>
                    </td>
                    <td style="width: 10%; color: red;"></td>
                </tr>
                @foreach ($conductores as $conductor)
                    <tr>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{$conductor->USR_Nombres_Usuario}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{'$ '.number_format($conductor->Producido, 0, ',', '.')}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{$conductor->Kilometraje}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{$conductor->Turnos}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{$conductor->PromedioKilometraje}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px;">
                                {{'$ '.number_format($conductor->PromedioTurno, 0, ',', '.')}}
                            </h3>
                        </td>
                        <td>
                            <h3 style="margin-bottom: 0px; color: red;">
                                @foreach ($conductor->turnosAsignados as $turno)
                                    {{($loop->last) ? ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)) : ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)).' y '}}
                                @endforeach
                            </h3>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br/><br/><br/>
        <table style="width: 50%;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="color: red; width: 15%; text-align:center;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Produced')}}
                        </h3>
                    </td>
                    <td style="width: 35%; text-align:left;">
                        <h3 style="margin-bottom: 0px;">
                            {{'$ '.number_format($mensual->Producido, 2, ',', '.')}}
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="color: red; width: 15%; text-align:center;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Expenses')}}
                        </h3>
                    </td>
                    <td style="width: 35%; text-align:left;">
                        <h3 style="margin-bottom: 0px;">
                            {{'$ '.number_format((!$gastos || $gastos->GST_Costo_Gasto == -1) ? 0 : $gastos->GST_Costo_Gasto, 2, ',', '.')}}
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="color: red; border-top:1px solid red; width: 15%; text-align:center;">
                        <h3 style="margin-bottom: 0px; color: red;">
                            {{Lang::get('messages.Gain')}}
                        </h3>
                    </td>
                    <td style="border-top:1px solid red; width: 35%; text-align:left;">
                        <h3 style="margin-bottom: 0px;">
                            {{'$ '.number_format($ganancia, 2, ',', '.')}}{{($propietarios > 1) ? ' / '.$propietarios.' =  $ '.number_format($ganancia/$propietarios, 2, ',', '.').' C/U' : ''}}
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</body>
</html>