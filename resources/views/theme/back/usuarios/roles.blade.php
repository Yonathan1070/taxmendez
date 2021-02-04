@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Roles')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Roles')}}</h3>
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
            <h4 class="card-title m-b-0">{{Lang::get('messages.AssignRoles')}} {{$usuario->USR_Nombres_Usuario}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            <div class="table-responsive m-t-40">
                <div id="accordian-3">
                    <form action="{{route('guardar_asignar_rol', ['id'=>Crypt::encrypt($usuario->id)])}}" method="POST">
                        @csrf
                        <div class="demo-checkbox">
                            @foreach ($roles as $rol)
                                <input type="checkbox" id="cbx_{{$rol->id}}" name="cbx_{{$rol->id}}" {{$rol->USR_RL_Usuario_Id == $usuario->id ? "checked" : ""}} />
                                <label for="cbx_{{$rol->id}}">
                                    {{(Lang::get('messages.'.$rol->RL_Slug_Rol) == 'messages.'.$rol->RL_Slug_Rol) ? $rol->RL_Nombre_Rol : Lang::get('messages.'.$rol->RL_Slug_Rol) }}
                                </label>
                            @endforeach
                        </div>
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