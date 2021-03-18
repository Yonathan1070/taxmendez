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
    <br/>
    <table style="width: 100%; text-align: center;" cellpadding="0" cellspacing="0">
        <tbody>
            <tr style="height:45px;">
                <td colspan="8" style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.AnnualBalanceCar'))}} {{$automovil->AUT_Numero_Interno_Automovil}} {{Str::upper(Lang::get('messages.Year'))}} {{Carbon\Carbon::parse('01-01-'.$anio)->format('Y')}}</td>
            </tr>
            <tr style="height:45px;">
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.Month'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.Produced'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.Expenses'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.TotalMileage'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.WorkedDays'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.AverageXDay'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.AverageXMileage'))}}</td>
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.Gain'))}}</td>
            </tr>
            @foreach ($anual as $mes)
                <tr style="height:45px;">
                    <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.'.Carbon\Carbon::parse($mes->MesAnio)->format('F')))}}</td>
                    <td style="border:1px solid red; height:45px;">{{'$ '.number_format($mes->Producido, 0, ',', '.')}}</td>
                    <td style="border:1px solid red; height:45px;">{{'$ '.number_format($mes->Gastos, 0, ',', '.')}}</td>
                    <td style="border:1px solid red; height:45px;">{{number_format($mes->Kilometraje, 0, ',', '.')}}</td>
                    <td style="border:1px solid red; height:45px;">{{$mes->DiasTrabajados}}</td>
                    <td style="border:1px solid red; height:45px;">{{'$ '.number_format($mes->PromedioDia, 0, ',', '.')}}</td>
                    <td style="border:1px solid red; height:45px;">{{number_format($mes->PromedioKilometraje, 0, ',', '.')}}</td>
                    <td style="border:1px solid red; height:45px;">{{'$ '.number_format(($mes->Producido - $mes->Gastos), 0, ',', '.')}}</td>
                </tr style="height:45px;">
            @endforeach
            <tr style="height:45px;">
                <td style="border:1px solid red; color: red; height:45px;">{{Str::upper(Lang::get('messages.Totals'))}}</td>
                <td style="border:1px solid red; height:45px;">{{'$ '.number_format(((!$totales) ? 0 : $totales->Producido), 0, ',', '.')}}</td>
                <td style="border:1px solid red; height:45px;">{{'$ '.number_format((!$totales) ? 0 : $totales->Gastos, 0, ',', '.')}}</td>
                <td style="border:1px solid red; height:45px;">{{number_format((!$totales) ? 0 : $totales->Kilometraje, 0, ',', '.')}}</td>
                <td style="border:1px solid red; height:45px;">{{(!$totales) ? 0 : $totales->DiasTrabajados}}</td>
                <td style="border:1px solid red; height:45px;">{{'$ '.number_format((!$totales) ? 0 : $totales->PromedioDia, 0, ',', '.')}}</td>
                <td style="border:1px solid red; height:45px;">{{number_format((!$totales) ? 0 : $totales->PromedioKilometraje, 0, ',', '.')}}</td>
                <td style="border:1px solid red; height:45px;">{{'$ '.number_format((!$totales) ? 0 : ($totales->Producido - $totales->Gastos), 0, ',', '.')}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>