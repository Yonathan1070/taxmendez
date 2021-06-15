<?php $totalGastos = 0; ?>
<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th>Costo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $gasto)
            <tr id="row{{$gasto->id}}">
                <td>{{$gasto->GST_Descripcion_Gasto}}</td>
                <td>{{'$ '.number_format($gasto->GST_Costo_Gasto, 0, ',', '.')}}</td>
                <td>
                    @if (can2('editar_gastos'))
                        <a href="{{route('editar_gastos', ['id'=>$automovil->id, 'idGasto'=>$gasto->id])}}" class="editar-registro">
                            <i class="ti-pencil"></i>
                        </a>
                    @endif
                    @if (can2('eliminar_gastos'))
                        <form action="{{route('eliminar_gastos', ['id' => $automovil->id, 'idGasto' => $gasto->id])}}" class="eliminar-registro d-inline" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-accion-tabla">
                                <i class="ti-trash text-danger"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            <?php $totalGastos += $gasto->GST_Costo_Gasto; ?>
        @endforeach
        <tr>
            <th>{{Lang::get('messages.Total')}}</th>
            <td>{{'$ '.number_format($totalGastos, 0, ',', '.')}}</td>
            <td></td>
        </tr>
    </tbody>
</table>