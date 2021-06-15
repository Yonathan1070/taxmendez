@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Users')}}
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Users')}}</h3>
    </div>
</div>
@endsection
@section('styles')
    <link href="{{asset('assets/back/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/back/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
@endsection
@section('contenido')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_usuario'))
                    <a href="{{route('crear_usuario')}}" id="nuevo-registro" data-modal="accion-usuario">
                        <i class="ti-plus"></i>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.UsersList')}}</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="table-responsive m-t-40">
                @include('theme.back.usuarios.table-data')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="accion-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <script src="{{asset('assets/back/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/back/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('assets/back/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/ajax.js')}}"></script>

    <script src="{{asset('assets/back/js/validation.js')}}"></script>

    <script>
        $(document).ready(function(){
            moment.locale('es-mx');
        });
    </script>
@endsection