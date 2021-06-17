<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Lang::get('messages.AddTurnInfo')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        <form action="{{route('actualizar_datos', ['id'=>$automovil->id, 'idTurno'=>$turnoAutomovil->id])}}" method="POST" novalidate id="form-general">
            @method('PUT')
            @include('theme.back.automoviles.form-agregar-datos')
            <div class="border-top">
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>