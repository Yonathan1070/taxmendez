@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Companies')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset("assets/back/plugins/dropify/dist/css/dropify.min.css")}}">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Companies')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('empresas')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.EditCompany')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form class="m-t-40" action="{{route('actualizar_empresa', ['id' => Crypt::encrypt($empresa->id)])}}" method="POST" enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('theme.back.empresas.form')
            </form>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
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

        $(document).ready(function() {
            // Basic
            $('.dropify').dropify({
                messages: {
                    'default': "{{Lang::get('messages.DropifyDefault')}}",
                    'replace': "{{Lang::get('messages.DropifyReplace')}}",
                    'remove':  "{{Lang::get('messages.DropifyRemove')}}",
                    'error':   "{{Lang::get('messages.DropifyError')}}"
                }
            });
        });
    </script>
@endsection