<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>{{Lang::get('messages.Rol')}}</th>
            <th>{{Lang::get('messages.Description')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $permEditar = can4('editar_roles'); $permEliminar = can4('eliminar_roles'); ?>
        @foreach ($roles as $rol)
            <tr id="row{{$rol->id}}">
                <td>{{$rol->RL_Nombre_Rol}}</td>
                <td>{{$rol->RL_Descripcion_Rol}}</td>
                <td>
                    @if (can2('editar_roles'))
                        <a href="{{route('editar_rol', $rol->id)}}" class="editar-registro">
                            <i class="{{$permEditar->PRM_Icono_Permiso}}"></i>
                        </a>
                    @endif
                    @if (can2('eliminar_roles'))
                        <form action="{{route('eliminar_rol', $rol->id)}}" class="eliminar-registro d-inline" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-accion-tabla">
                                <i class="{{$permEliminar->PRM_Icono_Permiso}} text-danger"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginador">
    <a href="{{$roles->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($roles->previousPageUrl() == '') ? 'disabled' : ''}} pagination">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$roles->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($roles->nextPageUrl() == '') ? 'disabled' : ''}} pagination">{{Lang::get('messages.Next')}}</a>
</div>