@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.ChannelName')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="CNT_Nombre_Canal_Notificacion" name="CNT_Nombre_Canal_Notificacion" data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('CNT_Nombre_Canal_Notificacion', $canal->CNT_Nombre_Canal_Notificacion ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.ChannelDescription')}}</h5>
                <div class="controls">
                    <textarea class="form-control" id="CNT_Descripcion_Canal_Notificacion" name="CNT_Descripcion_Canal_Notificacion" data-validation-required-message="{{Lang::get('messages.Required')}}">{{old('CNT_Descripcion_Canal_Notificacion', $canal->CNT_Descripcion_Canal_Notificacion ?? '')}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <br/>
            <div class="demo-checkbox">
                <input type="checkbox" id="CNT_Habilitado_Canal_Notificacion" name="CNT_Habilitado_Canal_Notificacion" {{(old('CNT_Habilitado_Canal_Notificacion', $empresa->CNT_Habilitado_Canal_Notificacion ?? "") == 1) ? 'checked' : ''}} />
                <label for="CNT_Habilitado_Canal_Notificacion">{{Lang::get('messages.Enabled')}}</label>
            </div>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('canal_notificacion')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>