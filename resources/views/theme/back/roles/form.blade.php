@csrf
<div class="form-group">
    <h5>{{Lang::get('messages.RolName')}}</h5>
    <div class="controls">
        <input type="text" name="RL_Nombre_Rol" id="RL_Nombre_Rol" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}"
            value="{{old('RL_Nombre_Rol', $rol->RL_Nombre_Rol ?? '')}}">
    </div>
</div>
<div class="form-group">
    <h5>{{Lang::get('messages.Description')}}</h5>
    <div class="controls">
        <textarea name="RL_Descripcion_Rol" id="RL_Descripcion_Rol" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}">{{old('RL_Descripcion_Rol', $rol->RL_Descripcion_Rol ?? '')}}</textarea>
    </div>
</div>