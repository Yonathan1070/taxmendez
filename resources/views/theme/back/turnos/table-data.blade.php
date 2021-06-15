<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>{{Lang::get('messages.Turn')}}</th>
            <th>{{Lang::get('messages.Value')}}</th>
            <th>{{Lang::get('messages.Description')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($turnos as $turno)
            <tr id="row{{$turno->id}}">
                <td>{{$turno->TRN_Nombre_Turno}}</td>
                <td>{{$turno->TRN_Valor_Turno}}</td>
                <td>{{$turno->TRN_Descripcion_Turno}}</td>
                <td>
                    @if (can2('editar_turno'))
                        <a href="{{route('editar_turno', $turno->id)}}" class="editar-registro">
                            <i class="ti-pencil"></i>
                        </a>
                    @endif
                    @if (can2('eliminar_turno'))
                        <form action="{{route('eliminar_turno', $turno->id)}}" class="eliminar-registro d-inline" method="POST">
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
    <a href="{{$turnos->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($turnos->previousPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_turnos')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$turnos->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($turnos->nextPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_turnos')}}">{{Lang::get('messages.Next')}}</a>
</div>