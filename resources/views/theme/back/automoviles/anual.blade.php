@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Automobiles')}}</h3>
    </div>
    @include('theme.back.automoviles.meses')
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('balance', ['id'=>Crypt::encrypt($automovil->id)])}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.AnnualBalance')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="table-responsive m-t-40">
                <table class="table table-bordered table-striped myTable" style="text-align: center;">
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
                                <td>{{'$ '.number_format($mes->Gastos, 0, ',', '.')}}</td>
                                <td>{{number_format($mes->Kilometraje, 0, ',', '.')}}</td>
                                <td>{{$mes->DiasTrabajados}}</td>
                                <td>{{'$ '.number_format($mes->PromedioDia, 0, ',', '.')}}</td>
                                <td>{{number_format($mes->PromedioKilometraje, 0, ',', '.')}}</td>
                                <td>{{'$ '.number_format(($mes->Producido - $mes->Gastos), 0, ',', '.')}}</td>
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
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')

@endsection