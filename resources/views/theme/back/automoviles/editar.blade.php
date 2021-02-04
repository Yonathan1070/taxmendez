@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/back/plugins/dropify/dist/css/dropify.min.css")}}">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Automobiles')}}</h3>
    </div>
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
            <h4 class="card-title m-b-0">{{Lang::get('messages.EditCar')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form action="{{route('actualizar_automovil', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST" novalidate enctype="multipart/form-data">
                @method('PUT')
                @include('theme.back.automoviles.form')
            </form>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset("assets/back/plugins/moment/moment.js")}}"></script>
    <script src="{{asset("assets/back/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")}}"></script>
    <!-- jQuery file upload -->
    <script src="{{asset("assets/back/plugins/dropify/dist/js/dropify.min.js")}}"></script>
@endsection
@section('scripts')
    <script src="{{asset("assets/back/js/validation.js")}}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
        }(window, document, jQuery);

        $('#AUT_Fecha_Vencimiento_Soat_Automovil').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            format: 'YYYY-MM-DD'
        });
        $('#AUT_Fecha_Vencimiento_Seguro_Actual_Automovil').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            format: 'YYYY-MM-DD'
        });
        $('#AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            format: 'YYYY-MM-DD'
        });
    </script>

    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });
        </script>
@endsection