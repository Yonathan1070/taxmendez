@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.AddExpenses')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.AddExpenses')}}</h3>
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
            <h4 class="card-title m-b-0">{{Lang::get('messages.AddExpensesCar')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form action="{{route('guardar_gastos', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST" novalidate>
                @include('theme.back.automoviles.gastos.form')
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