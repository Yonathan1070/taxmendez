@csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <h5>{{Lang::get('messages.Turn')}}</h5>
            <div class="controls">
                <input type="text" name="TRN_Nombre_Turno" id="TRN_Nombre_Turno" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('TRN_Nombre_Turno', $turno->TRN_Nombre_Turno ?? '')}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <h5>{{Lang::get('messages.Value')}}</h5>
            <div class="controls">
                <input type="text" name="TRN_Valor_Turno" id="TRN_Valor_Turno" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('TRN_Valor_Turno', $turno->TRN_Valor_Turno ?? '')}}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <h5>{{Lang::get('messages.Description')}}</h5>
            <div class="controls">
                <textarea name="TRN_Descripcion_Turno" id="TRN_Descripcion_Turno" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}">{{old('TRN_Descripcion_Turno', $turno->TRN_Descripcion_Turno ?? '')}}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <h5>{{Lang::get('messages.Color')}}</h5>
            <div class="col-10">
                <input type="color" name="TRN_Color_Turno" id="TRN_Color_Turno" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}"  value="{{old('TRN_Color_Turno', $turno->TRN_Color_Turno ?? '')}}">
            </div>
        </div>
    </div>
</div>