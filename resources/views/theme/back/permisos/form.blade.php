@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.PermissionName')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="PRM_Nombre_Permiso" name="PRM_Nombre_Permiso" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('PRM_Nombre_Permiso', $permiso->PRM_Nombre_Permiso ?? '')}}" pattern="[A-Za-z0-9 ]+" data-validation-pattern-message="{{Lang::get('messages.RegexOnlyNumbersAndLetters')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Route')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" name="PRM_Accion_Permiso" id="PRM_Accion_Permiso" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('PRM_Accion_Permiso', $permiso->PRM_Accion_Permiso ?? '')}}" pattern="[A-Za-z0-9_]+" data-validation-pattern-message="{{Lang::get('messages.RegexOnlyNumbersAndLetters_')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>{{Lang::get('messages.Category')}}</h5>
                <div class="controls">
                    <select name="PRM_Categoria_Permiso" id="PRM_Categoria_Permiso" class="form-control" required data-validation-required-message="{{Lang::get('messages.Required')}}">
                        <option value="">{{Lang::get('messages.SelectOption')}}</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{old("PRM_Categoria_Permiso", $permiso->PRM_Categoria_Permiso ?? "")==$categoria->id ? "selected" : ""}}>{{(Lang::get('messages.'.$categoria->CAT_Nick_Categoria) == 'messages.'.$categoria->CAT_Nick_Categoria) ? $categoria->CAT_Nombre_Categoria : Lang::get('messages.'.$categoria->CAT_Nick_Categoria) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <h5>{{Lang::get('messages.Icon')}}</h5>
                <div class="controls">
                    <input type="text" id="PRM_Icono_Permiso" name="PRM_Icono_Permiso" class="form-control" value="{{old('PRM_Icono_Permiso', $permiso->PRM_Icono_Permiso ?? '')}}" onkeyup="icono()" pattern="[A-Za-z0-9_ -]+" data-validation-pattern-message="{{Lang::get('messages.RegexOnlyNumbersAndLetters_-')}}"/>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <br/>
            <i id="mostrar-icono" class="{{old('PRM_Icono_Permiso', $permiso->PRM_Icono_Permiso ?? '')}}"></i>
            <br/>
            <a href="{{route('iconos')}}" target="_blank" style="font-size: 13px;">Ver Iconos</a>
        </div>
        <div class="col-md-3">
            <br/>
            <div class="demo-checkbox">
                <input type="checkbox" id="PRM_Menu_Permiso" name="PRM_Menu_Permiso" {{old("PRM_Menu_Permiso", $permiso->PRM_Menu_Permiso ?? "")==true ? "checked" : ""}} />
                <label for="PRM_Menu_Permiso">{{Lang::get('messages.MainMenu')}}</label>
            </div>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('permisos')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>