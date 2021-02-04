<li>
    @foreach (Route::getRoutes() as $route)
        @if ($route->getName() == $item->PRM_Accion_Permiso)
            <a class="has-arrow waves-effect waves-dark" href="{{route($item->PRM_Accion_Permiso)}}" aria-expanded="false">
                <i class="{{$item->PRM_Icono_Permiso}}"></i>
                <span class="hide-menu">{{(Lang::get('messages.'.$item->PRM_Slug_Permiso) == 'messages.'.$item->PRM_Slug_Permiso) ? $item->Nombre_Permiso : Lang::get('messages.'.$item->PRM_Slug_Permiso)}}</span>
            </a>
        @endif
    @endforeach
</li>