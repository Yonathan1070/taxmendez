@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Turns')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Turns')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('turnos')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.EditTurn')}} {{$turno->TRN_Nombre_Turno}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
            <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form class="m-t-40" action="{{route('actualizar_turno', ['id'=>Crypt::encrypt($turno->id)])}}" method="POST" novalidate>
                @method('PUT')
                @include('theme.back.turnos.form')
            </form>
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
@endsection