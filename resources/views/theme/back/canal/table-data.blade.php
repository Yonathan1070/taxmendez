<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>{{Lang::get('messages.ChannelName')}}</th>
            <th>{{Lang::get('messages.ChannelDescription')}}</th>
            <th>{{Lang::get('messages.Enabled')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($canales as $canal)
            <tr id="row{{$canal->id}}">
                <td>{{(Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion) == 'messages.'.$canal->CNT_Nick_Canal_Notificacion) ? $canal->CNT_Nombre_Canal_Notificacion : Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion)}}</td>
                <td>{{$canal->CNT_Descripcion_Canal_Notificacion}}</td>
                <td>
                    <div class="demo-checkbox">
                        <input type="checkbox" id="CNT_Habilitado_Canal_Notificacion_table" disabled name="CNT_Habilitado_Canal_Notificacion_table" {{($canal->CNT_Habilitado_Canal_Notificacion == 1) ? 'checked' : ''}} />
                        <label for="CNT_Habilitado_Canal_Notificacion_table"></label>
                    </div>
                </td>
                <td>
                    @if (can2('editar_canal_notificacion'))
                        <a href="{{route('editar_canal_notificacion', $canal->id)}}" class="editar-registro">
                            <i class="ti-pencil"></i>
                        </a>
                    @endif
                    @if (can2('eliminar_canal_notificacion'))
                        <form action="{{route('eliminar_canal_notificacion', $canal->id)}}" class="eliminar-registro d-inline" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-accion-tabla">
                                <i class="ti-trash text-danger"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginador">
    <a href="{{$canales->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($canales->previousPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_canales')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$canales->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($canales->nextPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_canales')}}">{{Lang::get('messages.Next')}}</a>
</div>