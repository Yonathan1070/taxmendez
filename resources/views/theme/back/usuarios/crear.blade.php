@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Users')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css")}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Users')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('usuarios')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.AddUser')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
            <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form class="m-t-40" action="{{route('guardar_usuario')}}" method="POST" novalidate>
                @include('theme.back.usuarios.form')
            </form>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset("assets/back/plugins/moment/moment.js")}}"></script>
    <script src="{{asset("assets/back/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")}}"></script>
@endsection
@section('scripts')
    <script src="{{asset("assets/back/js/validation.js")}}"></script>
    <script>
        $(document).ready(function(){
            moment.locale('es-mx');
        });

        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
        }(window, document, jQuery);

        $('#USR_Fecha_Vencimiento_Licencia_Usuario').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            format: 'YYYY-MM-DD',
            locale: 'es'
        });
        $('#USR_Fecha_Nacimiento_Usuario').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            format: 'YYYY-MM-DD'
        });

        function selectRol(sel) {
            var conductor = 'Conductor';
            if(sel.options[sel.selectedIndex].text.toLowerCase() == conductor.toLowerCase()){
                document.getElementById('divConductorFijo').style.display = 'block';
            }else{
                document.getElementById('divConductorFijo').style.display = 'none';
            }
        }
    </script>
@endsection