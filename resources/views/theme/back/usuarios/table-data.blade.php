<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
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
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr id="row{{$usuario->id}}">
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
                <td>
                    @if (can2('editar_usuario'))
                        <a href="{{route('editar_usuario', $usuario->id)}}" class="editar-registro">
                            <i class="ti-pencil"></i>
                        </a>
                    @endif
                    @if (can2('eliminar_usuario'))
                        <form action="{{route('eliminar_usuario', $usuario->id)}}" class="eliminar-registro d-inline" method="POST">
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
{{--<div id="paginador">
    <a href="{{$usuarios->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($usuarios->previousPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_usuarios')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$usuarios->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($usuarios->nextPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_usuarios')}}">{{Lang::get('messages.Next')}}</a>
</div>--}}