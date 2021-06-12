@csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <h5>{{Lang::get('messages.NIT')}}</h5>
            <div class="controls">
                <input type="text" class="form-control" id="EMP_NIT_Empresa" name="EMP_NIT_Empresa" data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('EMP_NIT_Empresa', $empresa->EMP_NIT_Empresa ?? '')}}" />
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <h5>{{Lang::get('messages.CompanyName')}}</h5>
            <div class="controls">
                <input type="text" class="form-control" id="EMP_Nombre_Empresa" name="EMP_Nombre_Empresa" data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('EMP_Nombre_Empresa', $empresa->EMP_Nombre_Empresa ?? '')}}" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <h5>{{Lang::get('messages.Phone')}}</h5>
            <div class="controls">
                <input type="text" class="form-control" id="EMP_Telefono_Empresa" name="EMP_Telefono_Empresa" data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('EMP_Telefono_Empresa', $empresa->EMP_Telefono_Empresa ?? '')}}" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <h5>{{Lang::get('messages.Address')}}</h5>
            <div class="controls">
                <input type="text" id="EMP_Direccion_Empresa" name="EMP_Direccion_Empresa" class="form-control" value="{{old('EMP_Direccion_Empresa', $empresa->EMP_Direccion_Empresa ?? '')}}" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <h5>{{Lang::get('messages.Email')}}</h5>
            <div class="controls">
                <input type="text" class="form-control" name="EMP_Correo_Empresa" id="EMP_Correo_Empresa" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('EMP_Correo_Empresa', $empresa->EMP_Correo_Empresa ?? '')}}" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <h5>{{Lang::get('messages.Logo')}}</h5>
            <div class="controls">
                <input type="file" id="EMP_Logo_Empresa" name="EMP_Logo_Empresa" class="dropify" />
            </div>
        </div>
    </div>
    @if (Route::currentRouteName() == 'editar_empresa' && ($empresa->EMP_Logo_Empresa != null || $empresa->EMP_Logo_Empresa != ''))
        <div class="col-md-2">
            <div class="form-group">
                <h5>{{Lang::get('messages.Logo')}}</h5>
                <div class="controls">
                    <img id="logoEmpresa" src="data:image/png;base64, {{$empresa->EMP_Logo_Empresa}}" width="50" height="27" alt="{{'Logo empresa '.$empresa->EMP_Nombre_Empresa}}" />
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-4">
            <div class="form-group">
            <h5>{{Lang::get('messages.LogoText')}}</h5>
            <div class="controls">
                <input type="file" id="EMP_Logo_Texto_Empresa" name="EMP_Logo_Texto_Empresa" class="dropify" />
            </div>
        </div>
    </div>
    @if (Route::currentRouteName() == 'editar_empresa' && ($empresa->EMP_Logo_Texto_Empresa != null || $empresa->EMP_Logo_Texto_Empresa != ''))
        <div class="col-md-2">
            <div class="form-group">
                <h5>{{Lang::get('messages.LogoText')}}</h5>
                <div class="controls">
                    <img id="logoTextoEmpresa" src="data:image/png;base64, {{$empresa->EMP_Logo_Texto_Empresa}}" width="148" height="29" alt="{{'Logo Texto empresa '.$empresa->EMP_Nombre_Empresa}}" />
                </div>
            </div>
        </div>
    @endif
</div>