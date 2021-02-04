@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <!-- Calendar CSS -->
    <link href="{{asset("assets/back/plugins/calendar/dist/fullcalendar.css")}}" rel="stylesheet" />
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
                <a class="mytooltip" href="{{route('automoviles')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.Balance')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div id="calendar"></div>
            <br />
            <form class="m-t-40" action="{{route('balance_diario', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                @csrf
                <input name="mesAnioTurnos" id="mesAnioTurnos" type="hidden">
                <button type="submit" id="turnos" class="btn btn-success">{{Lang::get('messages.Cuadro_Turnos')}}</button>
            </form>
            <form class="m-t-40" action="{{route('generar_balance', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                @csrf
                <input name="mesAnio" id="mesAnio" type="hidden">
                <button type="submit" id="mensualidad" class="btn btn-success" style="display:{{$boton}}">{{Lang::get('messages.GenerateMonthlyPayment')}}</button>
            </form>
            <form class="m-t-40" action="{{route('balance_anual', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                @csrf
                <input name="Anio" id="Anio" type="hidden">
                <button type="submit" id="anual" class="btn btn-success">{{Lang::get('messages.GenerateAnnualBalance')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <script src="{{asset("assets/back/plugins/calendar/jquery-ui.min.js")}}"></script>
    <script src="{{asset("assets/back/plugins/moment/moment.js")}}"></script>
    <script src='{{asset("assets/back/plugins/calendar/dist/fullcalendar.min.js")}}'></script>
    <script src="{{asset("assets/back/plugins/calendar/dist/locale/".session()->get("locale").".js")}}""></script>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            document.getElementById('mesAnioTurnos').value = '{{\Carbon\Carbon::now()->format("m-Y")}}';
            var calendar = $('#calendar').fullCalendar({
                defaultDate: "{{(session()->has('FechaCalendario')) ? session()->get('FechaCalendario') : Carbon\Carbon::now()->format('m-d-Y')}}",
                editable: true,
                events: "{{route('balance_obtener_datos', ['id'=>Crypt::encrypt($automovil->id)])}}",
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var fecha = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var today = $.fullCalendar.formatDate(moment(),'Y-MM-DD');

                    if(fecha <= today)
                    {
                        var formData = {
                            "_token": "{{ csrf_token() }}",
                            "fecha": fecha
                        };
                        $.ajax({
                            url: "{{route('balance_agregar_datos', ['id'=>Crypt::encrypt($automovil->id)])}}",
                            data: formData,
                            type: "POST",
                            success: function (data) {
                                window.location.href = data;
                            }
                        });
                    }
                    else
                    {
                        taxmendez.notificaciones('No puede acceder a este día', 'TaxMendez', 'error');
                    }
                },
                eventClick: function (event) {
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        "idTurnoAutomovil": event.id
                    };
                    $.ajax({
                        url: "{{route('balance_editar_datos', ['id'=>Crypt::encrypt($automovil->id)])}}",
                        data: formData,
                        type: "POST",
                        success: function (data) {
                            window.location.href = data;
                        }
                    });
                }
            });

            $('.fc-prev-button').click(function(){
                document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    "mes": $("#calendar").fullCalendar('getDate').format('MM'),
                    "anio": $("#calendar").fullCalendar('getDate').format('Y')
                };
                $.ajax({
                    url: "{{route('verificar_dias', ['id'=>Crypt::encrypt($automovil->id)])}}",
                    data: formData,
                    type: "POST",
                    success: function (data) {
                        if(data==100){
                            document.getElementById('mesAnio').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'block';
                        } else if(data==0){
                            document.getElementById('mesAnio').value = '';
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'none';
                        }
                    }
                });
            });
             
            $('.fc-next-button').click(function(){
                var formData = {
                    "_token": "{{ csrf_token() }}",
                    "mes": $("#calendar").fullCalendar('getDate').format('MM'),
                    "anio": $("#calendar").fullCalendar('getDate').format('Y')
                };
                $.ajax({
                    url: "{{route('verificar_dias', ['id'=>Crypt::encrypt($automovil->id)])}}",
                    data: formData,
                    type: "POST",
                    success: function (data) {
                        if(data==100){
                            document.getElementById('mesAnio').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'block';
                        } else if(data==0){
                            document.getElementById('mesAnio').value = '';
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
@endsection