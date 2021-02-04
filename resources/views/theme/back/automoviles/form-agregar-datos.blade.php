@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.TotalMileage')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="TRN_AUT_Kilometraje_Turno" id="TRN_AUT_Kilometraje_Turno" required data-validation-required-message="Este campo es requerido" value="{{old('TRN_AUT_Kilometraje_Turno', $turnoAutomovil->TRN_AUT_Kilometraje_Turno ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.TurnMileage')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="TRN_AUT_Kilometros_Andados_Turno" name="TRN_AUT_Kilometros_Andados_Turno" required data-validation-required-message="Este campo es requerido" value="{{old('TRN_AUT_Kilometros_Andados_Turno', $turnoAutomovil->TRN_AUT_Kilometros_Andados_Turno ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Produced')}}</h5>
                <div class="controls">
                    <input type="text" id="TRN_AUT_Producido_Turno" name="TRN_AUT_Producido_Turno" class="form-control" required data-validation-required-message="Este campo es requerido" value="{{old('TRN_AUT_Producido_Turno', $turnoAutomovil->TRN_AUT_Producido_Turno ?? '')}}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Driver')}}</h5>
                <div class="controls">
                    <select name="TRN_AUT_Usuario_Turno_Id" id="TRN_AUT_Usuario_Turno_Id" class="form-control" required data-validation-required-message="Este campo es requerido">
                        <option value="">{{Lang::get('messages.SelectOption')}}</option>
                        @foreach ($conductores as $conductor)
                            <option value="{{$conductor->id}}" {{old("TRN_AUT_Usuario_Turno_Id", $turnoAutomovil->TRN_AUT_Usuario_Turno_Id ?? "")==$conductor->id ? "selected" : ""}}>{{$conductor->USR_Nombres_Usuario.' '.$conductor->USR_Apellidos_Usuario}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Turn')}}</h5>
                <div class="controls">
                    <select name="TRN_AUT_Turno_Id" id="TRN_AUT_Turno_Id" class="form-control" required data-validation-required-message="Este campo es requerido">
                        <option value="">{{Lang::get('messages.SelectOption')}}</option>
                        @foreach ($turnos as $turno)
                            <option value="{{$turno->id}}" {{old("TRN_AUT_Turno_Id", $turnoAutomovil->TRN_AUT_Turno_Id ?? "")==$turno->id ? "selected" : ""}}>
                                {{(Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Observations')}}</h5>
                <div class="controls">
                    <textarea name="TRN_AUT_Observacion_Turno_Seleccionado" id="TRN_AUT_Observacion_Turno_Seleccionado" class="form-control" >{{old('TRN_AUT_Observacion_Turno_Seleccionado', $turnoAutomovil->TRN_AUT_Observacion_Turno_Seleccionado ?? '')}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('balance', ['id'=>Crypt::encrypt($automovil->id)])}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>