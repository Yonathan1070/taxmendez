<div class="card">
    <div class="card-body">
        <h4 class="card-title m-b-0">{{Lang::get('messages.AnnualBalance')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-striped" style="text-align: center;">
                <tbody>
                    <tr>
                        <td colspan="8">{{Str::upper(Lang::get('messages.AnnualBalanceCar'))}} {{$automovil->AUT_Numero_Interno_Automovil}} {{Str::upper(Lang::get('messages.Year'))}} {{Carbon\Carbon::parse('01-01-'.$anio)->format('Y')}}</td>
                    </tr>
                    <tr>
                        <td>{{Str::upper(Lang::get('messages.Month'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.Produced'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.Expenses'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.TotalMileage'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.WorkedDays'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.AverageXDay'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.AverageXMileage'))}}</td>
                        <td>{{Str::upper(Lang::get('messages.Gain'))}}</td>
                    </tr>
                    @foreach ($anual as $mes)
                        <tr>
                            <td>{{Str::upper(Lang::get('messages.'.Carbon\Carbon::parse($mes->MesAnio)->format('F')))}}</td>
                            <td>{{'$ '.number_format($mes->Producido, 0, ',', '.')}}</td>
                            <td>{{'$ '.number_format(((!$mes->Gastos) ? 0 : $mes->Gastos), 0, ',', '.')}}</td>
                            <td>{{number_format($mes->Kilometraje, 0, ',', '.')}}</td>
                            <td>{{$mes->DiasTrabajados}}</td>
                            <td>{{'$ '.number_format($mes->PromedioDia, 0, ',', '.')}}</td>
                            <td>{{number_format($mes->PromedioKilometraje, 0, ',', '.')}}</td>
                            <td>{{'$ '.number_format(($mes->Producido - ((!$mes->Gastos) ? 0 : $mes->Gastos)), 0, ',', '.')}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{Str::upper(Lang::get('messages.Totals'))}}</td>
                        <td>{{'$ '.number_format(((!$totales) ? 0 : $totales->Producido), 0, ',', '.')}}</td>
                        <td>{{'$ '.number_format((!$totales) ? 0 : $totales->Gastos, 0, ',', '.')}}</td>
                        <td>{{number_format((!$totales) ? 0 : $totales->Kilometraje, 0, ',', '.')}}</td>
                        <td>{{(!$totales) ? 0 : $totales->DiasTrabajados}}</td>
                        <td>{{'$ '.number_format((!$totales) ? 0 : $totales->PromedioDia, 0, ',', '.')}}</td>
                        <td>{{number_format((!$totales) ? 0 : $totales->PromedioKilometraje, 0, ',', '.')}}</td>
                        <td>{{'$ '.number_format((!$totales) ? 0 : ($totales->Producido - $totales->Gastos), 0, ',', '.')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($propietarios > 1)
            <div class="col-12">
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Gain')}}</h4>
                                <p class="card-text">{{Lang::get('messages.Divided').' '.$propietarios.' =  $ '.number_format(((!$totales) ? 0 : ($totales->Producido - $totales->Gastos))/$propietarios, 0, ',', '.').' '.Lang::get('messages.CU')}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
            </div>
        @endif

        <div class="border-top">
            <div class="card-body">
                <div class="row">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                    <form action="{{route('balance_anual_pdf', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                        @csrf
                        <input name="Anio" id="Anio" type="hidden" value="{{$anio}}">
                        <button type="submit" id="anual" class="btn btn-block btn-success">{{Lang::get('messages.GenerateAnnualBalance')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>