@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <!-- Calendar CSS -->
    <link href="{{asset('assets/back/plugins/calendar/dist/fullcalendar.css')}}" rel="stylesheet" />

    <style>
        .verticalText {
            writing-mode: vertical-lr;
            transform: rotate(180deg);
        }
        .table-turnos {border:1px solid red; border-bottom:0; text-align: center;}
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
<input type="hidden" id="modalName" data-modal="accion-balance">
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
        <div class="card-body collapse show b-t" id="balance-calendar">
            <div id="calendar"></div>
            <br />
            <div class="row button-group" id="actions">
                <div class="col-lg-3 col-md-4">
                    <form action="{{route('balance_diario', $automovil->id)}}" class="cuadro-turnos" method="POST">
                        @csrf
                        <input name="mesAnioTurnos" id="mesAnioTurnos" type="hidden">
                        @if (can2('balance_diario'))
                            <button type="submit" id="turnos" class="btn btn-block btn-success">{{Lang::get('messages.Cuadro_Turnos')}}</button>
                        @endif
                    </form>
                </div>
                <div class="col-lg-3 col-md-4">
                    <form action="{{route('generar_balance', $automovil->id)}}" class="cuadro-mensualidad" method="POST" id="mensualidad" style="display:{{$boton}}">
                        @csrf
                        <input name="mesAnio" id="mesAnio" type="hidden">
                        @if (can2('balance_mensual'))
                            <button type="submit" class="btn btn-block btn-success">{{Lang::get('messages.GenerateMonthlyPayment')}}</button>
                        @endif
                    </form>
                </div>
                <div class="col-lg-3 col-md-4">
                    <form action="{{route('balance_anual', $automovil->id)}}" class="cuadro-anual" method="POST">
                        @csrf
                        <input name="Anio" id="Anio" type="hidden">
                        @if (can2('balance_anual'))
                            <button type="submit" id="anual" class="btn btn-block btn-success">{{Lang::get('messages.GenerateAnnualBalance')}}</button>
                        @endif
                    </form>
                </div>
                <div class="col-lg-3 col-md-4">
                    <form action="{{route('agregar_gastos', $automovil->id)}}" method="POST" id="gastos">
                        @csrf
                        <input name="mesAnioGastos" id="mesAnioGastos" type="hidden">
                        @if (can2('gastos'))
                            <button type="submit" class="btn btn-block btn-success">{{Lang::get('messages.InsertExpenses')}}</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="accion-balance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <script src="{{asset('assets/back/plugins/calendar/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/back/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('assets/back/plugins/calendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/back/plugins/calendar/dist/locale/'.session()->get('locale').'.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/ajax.js')}}"></script>

    <script src="{{asset('assets/back/js/validation.js')}}"></script>
    <script>
        $(document).ready(function () {
            document.getElementById('mesAnioTurnos').value = '{{\Carbon\Carbon::now()->format("m-Y")}}';
            var calendar = $('#calendar').fullCalendar({
                defaultDate: "{{(session()->has('FechaCalendario')) ? session()->get('FechaCalendario') : Carbon\Carbon::now()->format('m-d-Y')}}",
                editable: true,
                events: "{{route('balance_obtener_datos', $automovil->id)}}",
                displayEventTime: false,
                loading: function (bool) {
                    if(!bool){
                        var fechaCalendar = moment($("#calendar").fullCalendar('getDate').format('Y')+$("#calendar").fullCalendar('getDate').format('MM')).format('YYYY-MM');
                        var fechaSistema = moment('{{\Carbon\Carbon::now()->format("Y-m")}}').format('YYYY-MM');
                        document.getElementById('gastos').style.display = (fechaCalendar<=fechaSistema) ? 'block' : 'none';
                        document.getElementById('mesAnio').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                        document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                        document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                        document.getElementById('mesAnioGastos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                    }
                },
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
                    $(".preloader").fadeIn();
                    var fecha = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var today = $.fullCalendar.formatDate(moment(),'Y-MM-DD');

                    if(fecha <= today)
                    {
                        var formData = {
                            "_token": "{{ csrf_token() }}",
                            "fecha": fecha
                        };
                        $.ajax({
                            url: "{{route('balance_agregar_datos', $automovil->id)}}",
                            data: formData,
                            type: "POST",
                            success: function (data) {
                                $('#accion-balance .modal-body').html(data);
                                validaciones();
                                $(".preloader").fadeOut();
                                $('#accion-balance').modal('show');
                            }
                        });
                    }
                    else
                    {
                        taxmendez.notificaciones('No puede acceder a este día', 'TaxMendez', 'error');
                    }
                },
                eventClick: function (event) {
                    $(".preloader").fadeIn();
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        "idTurnoAutomovil": event.id
                    };
                    $.ajax({
                        url: "{{route('balance_editar_datos', $automovil->id)}}",
                        data: formData,
                        type: "POST",
                        success: function (data) {
                            $('#accion-balance .modal-body').html(data);
                            validaciones();
                            $(".preloader").fadeOut();
                            $('#accion-balance').modal('show');
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
                            document.getElementById('mesAnioGastos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            //BTN Gastos Visible
                            var fechaCalendar = moment($("#calendar").fullCalendar('getDate').format('Y')+$("#calendar").fullCalendar('getDate').format('MM')).format('YYYY-MM');
                            var fechaSistema = moment('{{\Carbon\Carbon::now()->format("Y-m")}}').format('YYYY-MM');
                            document.getElementById('gastos').style.display = (fechaCalendar<=fechaSistema) ? 'block' : 'none';
                        } else if(data==0){
                            document.getElementById('mesAnio').value = '';
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'none';
                            document.getElementById('mesAnioGastos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            //BTN Gastos Visible
                            var fechaCalendar = moment($("#calendar").fullCalendar('getDate').format('Y')+$("#calendar").fullCalendar('getDate').format('MM')).format('YYYY-MM');
                            var fechaSistema = moment('{{\Carbon\Carbon::now()->format("Y-m")}}').format('YYYY-MM');
                            document.getElementById('gastos').style.display = (fechaCalendar<=fechaSistema) ? 'block' : 'none';
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
                            document.getElementById('mesAnioGastos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                        } else if(data==0){
                            document.getElementById('mesAnio').value = '';
                            document.getElementById('Anio').value = $("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mesAnioTurnos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                            document.getElementById('mensualidad').style.display = 'none';
                            document.getElementById('mesAnioGastos').value = $("#calendar").fullCalendar('getDate').format('MM')+'-'+$("#calendar").fullCalendar('getDate').format('Y');
                        }
                    }
                });
            });
        });
    </script>
@endsection