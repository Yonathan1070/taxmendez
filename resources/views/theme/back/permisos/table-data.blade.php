<table class="table table-bordered table-striped" id="data-table">
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
                <td>{{$permiso->PRM_Nombre_Permiso}} <i class="{{$permiso->PRM_Icono_Permiso}}"></i></td>
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
<div id="paginador">
    <a href="{{$permisos->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($permisos->previousPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_permisos')}}" >{{Lang::get('messages.Previous')}}</a>
    <a href="{{$permisos->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($permisos->nextPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_permisos')}}">{{Lang::get('messages.Next')}}</a>
</div>