@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Permissions')}}
@endsection
@section('styles')
    
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
                <a class="mytooltip" href="{{route('usuarios')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.AssignPermissions')}} {{$usuario->USR_Nombres_Usuario}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            <div class="table-responsive m-t-40">
                <div id="accordian-3">
                    <form action="{{route('guardar_permisos_usuario', $usuario->id)}}" method="POST">
                        @csrf
                        @foreach ($categorias as $categoria)
                            <div class="card m-b-0">
                                <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$categoria->id}}" aria-expanded="true" aria-controls="collapse1">
                                        <h5 class="m-b-0">
                                            {{(Lang::get('messages.'.$categoria->CAT_Nick_Categoria) == 'messages.'.$categoria->CAT_Nick_Categoria) ? $categoria->CAT_Nombre_Categoria : Lang::get('messages.'.$categoria->CAT_Nick_Categoria) }}
                                        </h5>
                                    </button>
                                </a>
                                <div id="collapse{{$categoria->id}}" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                                    <div class="card-body">
                                        <div class="demo-checkbox">
                                            @foreach ($permisosAsignados as $permiso)
                                                @if ($permiso->PRM_Categoria_Permiso == $categoria->id)
                                                    <input type="checkbox" id="cbx_{{$permiso->id}}" name="cbx_{{$permiso->id}}" checked />
                                                    <label for="cbx_{{$permiso->id}}">
                                                        {{(Lang::get('messages.'.$permiso->PRM_Slug_Permiso) == 'messages.'.$permiso->PRM_Slug_Permiso) ? $permiso->PRM_Nombre_Permiso : Lang::get('messages.'.$permiso->PRM_Slug_Permiso) }}
                                                    </label>
                                                @endif
                                            @endforeach
                                            @foreach ($permisosNoAsignados as $permiso)
                                                @if ($permiso->PRM_Categoria_Permiso == $categoria->id)
                                                    <input type="checkbox" id="cbx_{{$permiso->id}}" name="cbx_{{$permiso->id}}" />
                                                    <label for="cbx_{{$permiso->id}}">
                                                        {{(Lang::get('messages.'.$permiso->PRM_Slug_Permiso) == 'messages.'.$permiso->PRM_Slug_Permiso) ? $permiso->PRM_Nombre_Permiso : Lang::get('messages.'.$permiso->PRM_Slug_Permiso) }}
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
                            <a href="{{route('usuarios')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    
@endsection