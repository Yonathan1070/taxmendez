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
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_usuario'))
                    <a class="mytooltip" href="{{route('crear_usuario')}}">
                        <i class="ti-plus"></i>
                        <span class="tooltip-content3">
                            {{Lang::get('messages.AddUser')}}
                        </span>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.UsersList')}}</h4>
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
                            <th>{{Lang::get('messages.Name')}}</th>
                            <th>{{Lang::get('messages.LastName')}}</th>
                            <th>{{Lang::get('messages.Phone')}}</th>
                            <th>{{Lang::get('messages.Email')}}</th>
                            @if (can2('permisos_asignar'))
                                <th>{{Lang::get('messages.Permissions')}}</th>
                            @endif
                            @if (can2('roles_asignar'))
                                <th>{{Lang::get('messages.Roles')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->USR_Nombres_Usuario}}</td>
                                <td>{{$usuario->USR_Apellidos_Usuario}}</td>
                                <td>{{$usuario->USR_Telefono_Usuario}}</td>
                                <td>{{$usuario->USR_Correo_Usuario}}</td>
                                @if (can2('permisos_asignar'))
                                    <td>
                                        @if ($usuario->USR_RL_Estado == 1)
                                            <a href="{{route('permisos_usuario', ['id'=>Crypt::encrypt($usuario->id)])}}">
                                                {{Str::of(Lang::get('messages.'.can4('permisos_asignar')->PRM_Slug_Permiso))->explode(' ')[0]}}
                                            </a>
                                        @endif
                                    </td>
                                @endif
                                @if (can2('roles_asignar'))
                                    <td>
                                        <a href="{{route('asignar_rol', ['id'=>Crypt::encrypt($usuario->id)])}}">
                                            {{Str::of(Lang::get('messages.'.can4('roles_asignar')->PRM_Slug_Permiso))->explode(' ')[0]}}
                                        </a>
                                    </td>
                                @endif
                                @if (can2('editar_usuario'))
                                    <td>
                                        <a class="mytooltip" href="{{route('editar_usuario', ['id'=>Crypt::encrypt($usuario->id)])}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditUser')}} {{$usuario->USR_Nombres_Usuario}}
                                            </span>
                                        </a>
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