<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Lang::get('messages.AddTurn')}}</h4>
        <form class="m-t-40" action="{{route('guardar_turno')}}" method="POST" novalidate id="form-general">
            @include('theme.back.turnos.form')
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