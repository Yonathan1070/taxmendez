@csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.Rol')}}</h5>
                <div class="controls">
                    <select name="USR_Tipo_Usuario_Usuario" id="USR_Tipo_Usuario_Usuario" required class="form-control" data-validation-required-message="{{Lang::get('messages.Required')}}" onChange="selectRol(this);">
                        <option value="">{{Lang::get('messages.SelectOption')}}</option>
                        @foreach ($roles as $rol)
                            @if ($rol->RL_Nombre_Rol != 'Super Administrador')
                                <option value="{{$rol->id}}" {{old("USR_Tipo_Usuario_Usuario", $usuario->USR_RL_Rol_Id ?? "")==$rol->id ? "selected" : ""}}>
                                    {{(Lang::get('messages.'.$rol->RL_Slug_Rol) == 'messages.'.$rol->RL_Slug_Rol) ? $rol->RL_Nombre_Rol : Lang::get('messages.'.$rol->RL_Slug_Rol)}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.DocumentType')}}</h5>
                <div class="controls">
                    <select name="USR_Tipo_Documento_Usuario" id="USR_Tipo_Documento_Usuario" required class="form-control" data-validation-required-message="{{Lang::get('messages.Required')}}">
                        <option value="">{{Lang::get('messages.SelectOption')}}</option>
                        <option value="Cedula Ciudadania" {{old("USR_Tipo_Documento_Usuario", $usuario->USR_Tipo_Documento_Usuario ?? "")=="Cedula Ciudadania" ? "selected" : ""}}>
                            {{Lang::get('messages.cedula_ciudadania')}}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.NumberDocument')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="USR_Documento_Usuario" name="USR_Documento_Usuario" data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('USR_Documento_Usuario', $usuario->USR_Documento_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.ExpiryDatePass')}}</h5>
                <div class="controls">
                    <input type="text" id="USR_Fecha_Vencimiento_Licencia_Usuario" name="USR_Fecha_Vencimiento_Licencia_Usuario" class="form-control" value="{{old('USR_Fecha_Vencimiento_Licencia_Usuario', $usuario->USR_Fecha_Vencimiento_Licencia_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Name')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="USR_Nombres_Usuario" id="USR_Nombres_Usuario" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('USR_Nombres_Usuario', $usuario->USR_Nombres_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.LastName')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="USR_Apellidos_Usuario" id="USR_Apellidos_Usuario" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('USR_Apellidos_Usuario', $usuario->USR_Apellidos_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.BirthDate')}}</h5>
                <div class="controls">
                    <input type="text" id="USR_Fecha_Nacimiento_Usuario" name="USR_Fecha_Nacimiento_Usuario" class="form-control" value="{{old('USR_Fecha_Nacimiento_Usuario', $usuario->USR_Fecha_Nacimiento_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.Address')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="USR_Direccion_Residencia_Usuario" id="USR_Direccion_Residencia_Usuario" value="{{old('USR_Direccion_Residencia_Usuario', $usuario->USR_Direccion_Residencia_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.Phone')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="USR_Telefono_Usuario" id="USR_Telefono_Usuario" value="{{old('USR_Telefono_Usuario', $usuario->USR_Telefono_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.Email')}}</h5>
                <div class="controls">
                    <input type="text" id="USR_Correo_Usuario" name="USR_Correo_Usuario" class="form-control" value="{{old('USR_Correo_Usuario', $usuario->USR_Correo_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.UserName')}}</h5>
                <div class="controls">
                    <input type="text" id="USR_Nombre_Usuario" name="USR_Nombre_Usuario" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('USR_Nombre_Usuario', $usuario->USR_Nombre_Usuario ?? '')}}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (session()->get('Rol_Nombre') == 'Super Administrador')
            <div class="col-md-3">
                <div class="form-group">
                    <h5>{{Lang::get('messages.Company')}}</h5>
                    <div class="controls">
                        <select name="USR_Empresa_Id" id="USR_Empresa_Id" required class="form-control" data-validation-required-message="{{Lang::get('messages.Required')}}">
                            <option value="">{{Lang::get('messages.SelectOption')}}</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}" {{old("USR_Empresa_Id", $usuario->USR_Empresa_Id ?? "")==$empresa->id ? "selected" : ""}}>
                                    {{$empresa->EMP_Nombre_Empresa}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" id="USR_Empresa_Id" name="USR_Empresa_Id" value="{{session()->get('Empresa_Id')}}" />
        @endif
        <div class="col-md-1">
            <br/>
            <div class="demo-checkbox">
                <input type="checkbox" id="USR_Activo_Usuario" name="USR_Activo_Usuario" {{old("USR_Activo_Usuario", $usuario->USR_RL_Estado ?? "")==1 ? "checked" : ""}} />
                <label for="USR_Activo_Usuario">{{Lang::get('messages.Enabled')}}</label>
            </div>
        </div>
        <div id="divConductorFijo" class="col-md-1" style="display: {{empty($usuario) ? 'none' : ((Str::lower($usuario->RL_Nombre_Rol) == 'conductor') ? 'block' : 'none')}};">
            <br/>
            <div class="demo-checkbox">
                <input type="checkbox" id="USR_Conductor_Fijo_Usuario" name="USR_Conductor_Fijo_Usuario" {{old("USR_Conductor_Fijo_Usuario", $usuario->USR_Conductor_Fijo_Usuario ?? "")==1 ? "checked" : ""}} />
                <label for="USR_Conductor_Fijo_Usuario">{{Lang::get('messages.FixedDriver')}}</label>
            </div>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('usuarios')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>