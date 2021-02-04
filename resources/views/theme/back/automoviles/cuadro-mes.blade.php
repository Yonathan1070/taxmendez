@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <style>
        .verticalText {
            writing-mode: vertical-lr;
            transform: rotate(180deg);
        }
    </style>
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
            <h4 class="card-title m-b-0">{{Lang::get('messages.Monthly')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="col-12">
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                                <p class="card-text">{{'$ '.number_format($mensual->Producido, 2, ',', '.')}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Mileage')}}</h4>
                                <p class="card-text">{{$mensual->Kilometraje}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.WorkedDays')}}</h4>
                                <p class="card-text">{{$mensual->DiasTrabajados}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-6 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.AverageDay')}}</h4>
                                <p class="card-text">{{'$ '.number_format($mensual->PromedioDia, 2, ',', '.')}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-6 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.AveragePerMileage')}}</h4>
                                <p class="card-text">{{$mensual->PromedioKilometraje}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-12 col-md-12">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped myTable">
                                        <thead>
                                            <tr>
                                                <th>{{Lang::get('messages.Driver')}}</th>
                                                <th>{{Lang::get('messages.Produced')}}</th>
                                                <th>{{Lang::get('messages.Mileage')}}</th>
                                                <th>{{Lang::get('messages.Turns')}}</th>
                                                <th>{{Lang::get('messages.AverageMileage')}}</th>
                                                <th>{{Lang::get('messages.AverageTurn')}}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($conductores as $conductor)
                                                <tr>
                                                    <td>{{$conductor->USR_Nombres_Usuario}}</td>
                                                    <td>{{'$ '.number_format($conductor->Producido, 0, ',', '.')}}</td>
                                                    <td>{{$conductor->Kilometraje}}</td>
                                                    <td>{{$conductor->Turnos}}</td>
                                                    <td>{{$conductor->PromedioKilometraje}}</td>
                                                    <td>{{'$ '.number_format($conductor->PromedioTurno, 0, ',', '.')}}</td>
                                                    <td style="color: red;">
                                                        @foreach ($conductor->turnosAsignados as $turno)
                                                            {{($loop->last) ? ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)) : ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)).' y '}}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                                <p class="card-text">{{'$ '.number_format($mensual->Producido, 2, ',', '.')}}</p>
                                <h4 class="card-title">{{Lang::get('messages.Expenses')}}</h4>
                                <p class="card-text" id="label" style="display: {{($gastos && $gastos->GST_Costo_Gasto >= 0) ? 'block' : 'none'}}">{{'$ '.number_format((!$gastos) ? 0 : $gastos->GST_Costo_Gasto, 2, ',', '.')}}</p>
                                <p class="card-text" id="form" style="display: {{(!$gastos || $gastos->GST_Costo_Gasto == -1) ? 'block' : 'none'}}">
                                    <form id="formulario" style="display: {{(!$gastos || $gastos->GST_Costo_Gasto == -1) ? 'block' : 'none'}}" novalidate>
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" class="form-control" name="GST_Costo_Gasto" id="GST_Costo_Gasto" required data-validation-required-message="{{Lang::get('messages.Required')}}" />
                                            </div>
                                        </div>
                                        <button type="button" id="GuardarGastos" class="btn btn-info">{{Lang::get('messages.SaveExpenses')}}</button>
                                    </form>
                                </p>
                                <h4 class="card-title">{{Lang::get('messages.Gain')}}</h4>
                                <p class="card-text" id="ganancia">
                                    {{'$ '.number_format($ganancia, 2, ',', '.')}}{{($propietarios > 1) ? ' / '.$propietarios.' =  $ '.number_format($ganancia/$propietarios, 2, ',', '.').' C/U' : ''}}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script src="{{asset("assets/back/js/validation.js")}}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
        }(window, document, jQuery);
    </script>
    <script>
        $('#GuardarGastos').click(function(){
            var formData = {
                "_token": "{{ csrf_token() }}",
                "Gastos": (document.getElementById('GST_Costo_Gasto').value == "") ? -1 : document.getElementById('GST_Costo_Gasto').value,
                "MesAnio": "{{$fecha[0].'-'.$fecha[1]}}"
            };
            $.ajax({
                url: "{{route('guardar_gastos', ['id'=>Crypt::encrypt($automovil->id)])}}",
                data: formData,
                type: "POST",
                success: function (data) {
                    if(data.mensaje =='noGastos'){
                        taxmendez.notificaciones('Por favor digite un valor en los gastos', 'TaxMendez', 'error');
                    } else if(data.mensaje =='ok'){
                        $('#label').text('$ '+formatMoney(document.getElementById('GST_Costo_Gasto').value));
                        document.getElementById('form').style.display = 'none';
                        document.getElementById('formulario').style.display = 'none';
                        document.getElementById('label').style.display = 'block';
                        $('#ganancia').text('$ '+formatMoney("{{$mensual->Producido}}" - document.getElementById('GST_Costo_Gasto').value) + ((data.propietarios > 1) ? ' / '+data.propietarios+' = '+'$ '+formatMoney(("{{$mensual->Producido}}" - document.getElementById('GST_Costo_Gasto').value)/data.propietarios)+' C/U' : ''));
                        taxmendez.notificaciones('Gastos Agregados', 'TaxMendez', 'success');
                    }
                    /*if(data==100){
                        document.getElementById('mesAnio').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                        document.getElementById('mensualidad').style.display = 'block';
                    } else if(data==0){
                        document.getElementById('mesAnio').value = '';
                        document.getElementById('mensualidad').style.display = 'none';
                    }*/
                }
            });
        });

        function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
            try {
              decimalCount = Math.abs(decimalCount);
              decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
          
              const negativeSign = amount < 0 ? "-" : "";
          
              let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
              let j = (i.length > 3) ? i.length % 3 : 0;
          
              return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
              console.log(e)
            }
          };
    </script>
@endsection