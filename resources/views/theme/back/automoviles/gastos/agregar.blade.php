<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Lang::get('messages.AddExpensesCar')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
        <form action="{{route('guardar_gastos', $automovil->id)}}" method="POST" novalidate id="form-general">
            @include('theme.back.automoviles.gastos.form')
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