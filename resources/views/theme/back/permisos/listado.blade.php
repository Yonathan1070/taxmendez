@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Permissions')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Permissions')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('ordenar_menu')}}">
                    <i class="ti-reload"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.ShortMenu')}}
                    </span>
                </a>
                <a class="mytooltip" href="{{route('crear_permiso')}}">
                    <i class="ti-plus"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.AddPermission')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.PermissionList')}}</h4>
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
                            <th>{{Lang::get('messages.Permission')}}</th>
                            <th>{{Lang::get('messages.Category')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $permiso)
                            <tr>
                                <td>{{$permiso->PRM_Nombre_Permiso}} <i class="mdi {{$permiso->PRM_Icono_Permiso}}"></i></td>
                                <td>{{(Lang::get('messages.'.$permiso->CAT_Nick_Categoria) == 'messages.'.$permiso->CAT_Nick_Categoria) ? $permiso->CAT_Nombre_Categoria : Lang::get('messages.'.$permiso->CAT_Nick_Categoria) }}</td>
                                <td>
                                    <a class="mytooltip" href="{{route('editar_permiso', ['id'=>Crypt::encrypt($permiso->id)])}}">
                                        <i class="ti-pencil"></i>
                                        <span class="tooltip-content3">
                                            {{Lang::get('messages.EditPermission')}} {{$permiso->PRM_Nombre_Permiso}}
                                        </span>
                                    </a>
                                </td>
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