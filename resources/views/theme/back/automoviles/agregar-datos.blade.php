<div class="card">
    <h4 class="card-title">{{Lang::get('messages.AddTurnInfo')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
    <div class="card-body">
        <form action="{{route('guardar_datos', ['id'=>$automovil->id, 'fecha'=>$fecha])}}" method="POST" novalidate autocomplete="off" id="form-general">
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