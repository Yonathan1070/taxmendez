<form class="m-t-40" action="{{route('guardar_rol')}}" method="POST" novalidate>
    @csrf
    <div class="form-group">
        <h5>{{Lang::get('messages.RolName')}}</h5>
        <div class="controls">
            <input type="text" name="RL_Nombre_Rol" id="RL_Nombre_Rol" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}">
        </div>
    </div>
    <div class="form-group">
        <h5>{{Lang::get('messages.Description')}}</h5>
        <div class="controls">
            <textarea name="RL_Descripcion_Rol" id="RL_Descripcion_Rol" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}"></textarea>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('roles')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>
</form>