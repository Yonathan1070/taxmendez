@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.NotificationChannel')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.NotificationChannel')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_empresa'))
                    <a class="mytooltip" href="{{route('crear_canal_notificacion')}}">
                        <i class="ti-plus"></i>
                        <span class="tooltip-content3">
                            {{Lang::get('messages.AddNotificationChannel')}}
                        </span>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.NotificationChannelList')}}</h4>
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
                            <th>{{Lang::get('messages.ChannelName')}}</th>
                            <th>{{Lang::get('messages.ChannelDescription')}}</th>
                            <th>{{Lang::get('messages.Enabled')}}</th>
                            @if (can2('editar_canal_notificacion'))
                                <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($canales as $canal)
                            <tr>
                                <td>{{(Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion) == 'messages.'.$canal->CNT_Nick_Canal_Notificacion) ? $canal->CNT_Nombre_Canal_Notificacion : Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion)}}</td>
                                <td>{{$canal->CNT_Descripcion_Canal_Notificacion}}</td>
                                <td>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" id="CNT_Habilitado_Canal_Notificacion" disabled name="CNT_Habilitado_Canal_Notificacion" {{($canal->CNT_Habilitado_Canal_Notificacion == 1) ? 'checked' : ''}} />
                                        <label for="CNT_Habilitado_Canal_Notificacion"></label>
                                    </div>
                                </td>
                                @if (can2('editar_canal_notificacion'))
                                    <td>
                                        <a class="mytooltip" href="{{route('editar_canal_notificacion', ['id'=>Crypt::encrypt($canal->id)])}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditChannel')}} {{(Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion) == 'messages.'.$canal->CNT_Nick_Canal_Notificacion) ? $canal->CNT_Nombre_Canal_Notificacion : Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion)}}
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
    
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/general.js')}}"></script>
@endsection