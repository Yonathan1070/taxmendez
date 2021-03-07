@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.ControlDesinfeccion')}}
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.ControlDesinfeccion')}}</h3>
    </div>
</div>
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_desinfeccion'))
                    <a class="mytooltip" href="{{route('crear_desinfeccion')}}">
                        <i class="ti-plus"></i>
                        <span class="tooltip-content3">
                            {{Lang::get('messages.AddDesinfeccion')}}
                        </span>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.DesinfeccionList')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="table-responsive m-t-40">

                <table class="table table-bordered table-striped myTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{Lang::get('messages.DateTime')}}</th>
                            <th>{{Lang::get('messages.Car')}}</th>
                            <th>{{Lang::get('messages.Driver')}}</th>
                            <th>{{Lang::get('messages.Temperature')}}</th>
                            <th>{{Lang::get('messages.Signature')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tablaControl as $desinfeccion)
                            <tr>
                                <td>{{$desinfeccion->CTD_Fecha_Hora_Desinfeccion}}</td>
                                <td>{{$desinfeccion->AUT_Numero_Interno_Automovil}}</td>
                                <td>{{$desinfeccion->USR_Nombres_Usuario." ".$desinfeccion->USR_Apellidos_Usuario}}</td>
                                <td>{{$desinfeccion->CTD_Temperatura_Control_Desinfeccion}}</td>
                                <td>
                                    <img src="data:image/png;base64, {{$desinfeccion->CTD_Firma_Control_Desinfeccion}}" alt="{{'Firma '.$desinfeccion->CTD_Usuario_Id}}" height="100px" />
                                </td>
                                @if (can2('editar_desinfeccion'))
                                    <td>
                                        {{--<a class="mytooltip" href="{{route('editar_usuario', ['id'=>Crypt::encrypt($usuario->id)])}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditUser')}} {{$usuario->USR_Nombres_Usuario}}
                                            </span>
                                        </a>--}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    <script src="{{asset("assets/back/plugins/datatables/datatables.min.js")}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/general.js')}}"></script>
@endsection