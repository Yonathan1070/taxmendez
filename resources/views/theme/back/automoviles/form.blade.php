@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.LicensePlate')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="AUT_Placa_Automovil" name="AUT_Placa_Automovil" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('AUT_Placa_Automovil', $automovil->AUT_Placa_Automovil ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.InternNumber')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="AUT_Numero_Interno_Automovil" id="AUT_Numero_Interno_Automovil" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('AUT_Numero_Interno_Automovil', $automovil->AUT_Numero_Interno_Automovil ?? '')}}" />
                </div>
            </div>
        </div>
        @if (session()->get('Rol_Nombre') == 'Super Administrador')
            <div class="col-md-4">
                <div class="form-group">
                    <h5>{{Lang::get('messages.Company')}}</h5>
                    <div class="controls">
                        <select name="AUT_Empresa_Id" id="AUT_Empresa_Id" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}">
                            <option value="">{{Lang::get('messages.SelectOption')}}</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}" {{old("AUT_Empresa_Id", $automovil->AUT_Empresa_Id ?? "")==$empresa->id ? "selected" : ""}}>{{$empresa->EMP_Nombre_Empresa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" id="AUT_Empresa_Id" name="AUT_Empresa_Id" value="{{session()->get('Empresa_Id')}}" />
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.ExpiryDateSoat')}}</h5>
                <div class="controls">
                    <input type="text" id="AUT_Fecha_Vencimiento_Soat_Automovil" name="AUT_Fecha_Vencimiento_Soat_Automovil" class="form-control" value="{{old('AUT_Fecha_Vencimiento_Soat_Automovil', $automovil->AUT_Fecha_Vencimiento_Soat_Automovil ?? '')}}" required data-validation-required-message="{{Lang::get('messages.Required')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.ExpiryDateContractual')}}</h5>
                <div class="controls">
                    <input type="text" id="AUT_Fecha_Vencimiento_Seguro_Actual_Automovil" name="AUT_Fecha_Vencimiento_Seguro_Actual_Automovil" class="form-control" value="{{old('AUT_Fecha_Vencimiento_Seguro_Actual_Automovil', $automovil->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil ?? '')}}" required data-validation-required-message="{{Lang::get('messages.Required')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.ExpiryDateExtracontractual')}}</h5>
                <div class="controls">
                    <input type="text" id="AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil" name="AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil" class="form-control" value="{{old('AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil', $automovil->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil ?? '')}}" required data-validation-required-message="{{Lang::get('messages.Required')}}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.CarImage')}}</h5>
                <div class="controls">
                    <input type="file" id="AUT_Foto_Automovil" name="AUT_Foto_Automovil" class="dropify" />
                </div>
            </div>
        </div>
        @if (Route::currentRouteName() == 'editar_automovil' && $automovil->AUT_Foto_Automovil != null)
            <div class="col-md-2">
                <div class="form-group">
                    <h5>{{Lang::get('messages.CarImage')}}</h5>
                    <div class="controls">
                        <img id="fotoAutomovil" src="data:image/png;base64, {{$automovil->AUT_Foto_Automovil}}" width="128" height="128" alt="{{'Foto automovil '.$automovil->AUT_Numero_Interno_Automovil}}" />
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('automoviles')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>