<aside class="left-sidebar">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{asset("assets/back/images/background/user-info.jpg")}}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img">
                @if ($datosUsuario->USR_Foto_Perfil_Usuario != null)
                    <img id="Foto_Perfil_Aside" src="data:image/png;base64, {{$datosUsuario->USR_Foto_Perfil_Usuario}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}"  class="profile-pic" />
                @else
                    <img id="Foto_Perfil_Aside" src="{{asset("assets/back/images/users/usericon.png")}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="profile-pic" />
                @endif
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    {{$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}
                </a>
                <div class="dropdown-menu animated flipInY">
                    <a href="{{route('perfil')}}" class="dropdown-item"><i class="ti-user"></i> {{Lang::get('messages.MyProfile')}}</a>
                    @if (session()->get('Rol_Nombre') == 'Administrador')
                        <a href="{{route('editar_empresa_usuario')}}" class="dropdown-item"><i class="mdi mdi-domain"></i>{{Lang::get('messages.Company')}}</a>
                    @endif
                    {{--<a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>--}}
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{Lang::get('messages.Logout')}}</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">PERSONAL</li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="{{route('administracion')}}" aria-expanded="false">
                        <i class="mdi mdi-home"></i>
                        <span class="hide-menu">{{Lang::get('messages.Home')}} </span>
                    </a>
                </li>
                @if (session()->get('Usuario_Id') == 1)
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="{{route('permisos')}}" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">{{Lang::get('messages.Permissions')}} </span></a>
                    </li>
                @endif
                @include('theme.back.menu')
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        {{--<!-- item--><a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>--}}
        <!-- item--><a href="{{ route('logout') }}" class="link" data-toggle="tooltip" title="{{Lang::get('messages.Logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>