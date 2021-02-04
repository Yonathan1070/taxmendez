@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Menu')}}
@endsection
@section('styles')
    <!--nestable CSS -->
    <link href="{{asset('assets/back/plugins/nestable/nestable.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Menu')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('permisos')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.ShortMenu')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="col-lg-12 col-md-12">
                @csrf
                <div class="myadmin-dd dd" id="nestable">
                    <ol class="dd-list">
                        @foreach ($menu as $item)
                            <li class="dd-item" data-id="{{$item->id}}">
                                <div class="dd-handle"> <i class="{{$item->PRM_Icono_Permiso}}"></i> {{(Lang::get('messages.'.$item->PRM_Slug_Permiso) == 'messages.'.$item->PRM_Slug_Permiso) ? $item->PRM_Nombre_Permiso : Lang::get('messages.'.$item->PRM_Slug_Permiso) }} </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-lg-12 col-md-12" style="display: none;">
                <div class="myadmin-dd-empty dd" id="nestable2">
                </div>
            </div>
            <div class="col-lg-4 col-md-12" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <div class="dd myadmin-dd" id="nestable-menu">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <!--Nestable js -->
    <script src="{{asset('assets/back/plugins/nestable/jquery.nestable.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#nestable').nestable().on('change', function(){
                const data = {
                    menu:window.JSON.stringify($('#nestable').nestable('serialize')),
                    _token: $('input[name=_token]').val()
                };
                $.ajax({
                    url:'guardarorden',
                    type:'POST',
                    dataType:'JSON',
                    data:data,
                    success:function(respuesta){
                        taxmendez.notificaciones(respuesta.mensaje, respuesta.TM, respuesta.type);
                    }
                });
            });
        
            $('#nestable').nestable('expandAll');
        });
    </script>
@endsection