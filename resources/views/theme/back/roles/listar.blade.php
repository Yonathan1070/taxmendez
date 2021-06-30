@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Roles')}}
@endsection
@section('styles')
    <link href="{{asset('assets/back/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Roles')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<input type="hidden" id="modalName" data-modal="accion-rol">
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_rol'))
                    <a href="{{route('crear_rol')}}" id="nuevo-registro">
                        <i class="ti-plus"></i>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.RolesList')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="table-responsive m-t-40">
                @include('theme.back.roles.table-data')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="accion-rol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <script src="{{asset('assets/back/plugins/sweetalert/sweetalert.min.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/ajax.js')}}"></script>
    
    <script src="{{asset('assets/back/js/validation.js')}}"></script>
@endsection