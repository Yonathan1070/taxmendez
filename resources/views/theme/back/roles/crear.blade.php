<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Lang::get('messages.AddRol')}}</h4>
        <form action="{{route('guardar_rol')}}" class="m-t-40" method="POST" novalidate id="form-general">
            @include('theme.back.roles.form')
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