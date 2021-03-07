<div class="search" id="search">
    <table class="search-table" id="searchTable">
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="{{route('administracion')}}" class="btn btn-block btn-light">{{Lang::get('messages.Home')}}</a></td>
            </tr>
            @if (session()->get('Usuario_Id') == 1)
                <tr>
                    <td><a href="{{route('permisos')}}" class="btn btn-block btn-light">{{Lang::get('messages.PermissionList')}}</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('crear_permiso')}}" class="btn btn-block btn-light">{{Lang::get('messages.AddPermission')}}</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('ordenar_menu')}}" class="btn btn-block btn-light">{{Lang::get('messages.ShortMenu')}}</a></td>
                </tr>
            @endif
            @foreach ($menusComposer as $key => $item)
                @foreach (Route::getRoutes() as $route)
                    @if ($route->getName() == $item->PRM_Accion_Permiso)
                        <tr>
                            <td><a href="{{route($item->PRM_Accion_Permiso)}}" class="btn btn-block btn-light">{{(Lang::get('messages.'.$item->PRM_Slug_Permiso) == 'messages.'.$item->PRM_Slug_Permiso) ? $item->PRM_Nombre_Permiso : Lang::get('messages.'.$item->PRM_Slug_Permiso)}}</a></td>
                        </tr>
                        @break
                    @endif
                @endforeach
            @endforeach
            @if (can2('crear_rol'))
                <tr>
                    <td><a href="{{route('crear_rol')}}" class="btn btn-block btn-light">{{Lang::get('messages.AddRol')}}</a></td>
                </tr>
            @endif
            @if (can2('crear_turno'))
                <tr>
                    <td><a href="{{route('crear_turno')}}" class="btn btn-block btn-light">{{Lang::get('messages.AddTurn')}}</a></td>
                </tr>
            @endif
            @if (can2('crear_usuario'))
                <tr>
                    <td><a href="{{route('crear_usuario')}}" class="btn btn-block btn-light">{{Lang::get('messages.AddUser')}}</a></td>
                </tr>
            @endif
            @if (can2('crear_automovil'))
                <tr>
                    <td><a href="{{route('crear_automovil')}}" class="btn btn-block btn-light">{{Lang::get('messages.AddCar')}}</a></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>