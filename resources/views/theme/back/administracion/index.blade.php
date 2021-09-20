@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Home')}}
@endsection
@section('styles')
    <!--This page css - Morris CSS -->
    <link href="{{asset('assets/back/plugins/morrisjs/morris.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Home')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        @if ($errors->any())
            <x-alert tipo="danger" :mensaje="$errors" />
        @endif
        @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
        @endif
        <div class="card-header">
            <div class="card-actions">
                
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.Home')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if (can2('indicadores'))
                <div class="col-md-4">
                    <div class="switch">
                        <label>
                            {{Lang::get('messages.Monthly')}}
                            <input type="checkbox" id="cambiar-modo" data-url="{{route('administracion_indicadores')}}"><span class="lever"></span>
                            <input type="hidden" name="divName" id="divName" value="{{(session()->get('Rol_Nombre') == 'Super Administrador') ? 'accion-super' : 'accion-general'}}">
                            {{Lang::get('messages.Annual')}}
                        </label>
                    </div>
                </div>

                <?php
                    $diferencia=0;
                    $porcentaje=0;
                ?>
                
                @include('theme.back.administracion.indicadores')
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ribbon-wrapper-reverse card">
                        <div class="ribbon ribbon-bookmark ribbon-danger">
                            {{Lang::get('messages.Alert')}}
                        </div>
                        <p class="ribbon-content">
                            {{Lang::get('messages.AccessDeniedIndicators')}}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/ajax.js')}}"></script>
@endsection