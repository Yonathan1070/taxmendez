<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('administracion')}}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    @if ($empresa->EMP_Logo_Empresa != null || $empresa->EMP_Logo_Empresa != '')
                        <img id="Logo" src="data:image/png;base64, {{$empresa->EMP_Logo_Empresa}}" alt="homepage" class="dark-logo" height="27" width="50" />
                    @else
                        <img id="Logo" src="{{asset("assets/back/images/logo-icon.png")}}" alt="homepage" class="dark-logo" height="27" width="50" />
                    @endif
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    @if ($empresa->EMP_Logo_Texto_Empresa != null || $empresa->EMP_Logo_Texto_Empresa != '')
                        <img id="Logo_Texto" src="data:image/png;base64, {{$empresa->EMP_Logo_Texto_Empresa}}" alt="homepage" class="dark-logo" height="29" width="148" />    
                    @else
                        <img id="Logo_Texto" src="{{asset("assets/back/images/logo-text.png")}}" alt="homepage" class="dark-logo"  height="29" width="148" />
                    @endif
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item hidden-sm-down search-box">
                    <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="{{Lang::get('messages.Search')}}..." id="inputSearch" autocomplete="off" />
                        <a class="srh-btn"><i class="ti-close"></i></a>
                        @include('theme.back.buscador')
                    </form>
                </li>

                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                    <div class="dropdown-menu scale-up-left">
                        <ul class="mega-dropdown-menu row">
                            <li class="col-lg-3 col-xlg-2 m-b-30">
                                <h4 class="m-b-20">{{Str::upper(Lang::get('messages.Automobiles'))}}</h4>
                                <!-- CAROUSEL -->
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        @foreach ($automovilesFotos as $automovil)
                                            <div class="carousel-item {{($automovilesFotos->first()->id == $automovil->id) ? 'active' : ''}}">
                                                <div class="container">
                                                    <img class="d-block img-fluid" src="data:image/png;base64, {{$automovil->AUT_Foto_Automovil}}" alt="{{'Foto automovil '.$automovil->AUT_Numero_Interno_Automovil}}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                </div>
                                <!-- End CAROUSEL -->
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Notificactions -->
                <!-- ============================================================== -->
                @foreach ($canales as $canal)
                    @if ((Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'Web') || Str::contains($canal->CNT_Nombre_Canal_Notificacion, 'web')) && $canal->CNT_Habilitado_Canal_Notificacion)
                        @include('theme.back.notificaciones')
                        @break
                    @endif
                @endforeach
                <!-- ============================================================== -->
                <!-- End Notificactions -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                {{--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                        <ul>
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <!-- Message -->
                                    <a href="#">
                                        <div class="user-img"> <img src="{{asset("assets/back/images/users/1.jpg")}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="#">
                                        <div class="user-img"> <img src="{{asset("assets/back/images/users/2.jpg")}}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I ve sung a song! See you at</span> <span class="time">9:10 AM</span>
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="#">
                                        <div class="user-img"> <img src="{{asset("assets/back/images/users/3.jpg")}}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span>
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a href="#">
                                        <div class="user-img"> <img src="{{asset("assets/back/images/users/4.jpg")}}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>--}}
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if ($datosUsuario->USR_Foto_Perfil_Usuario != null)
                            <img id="Foto_Perfil_Top" src="data:image/png;base64, {{$datosUsuario->USR_Foto_Perfil_Usuario}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}"  class="profile-pic" />
                        @else
                            <img id="Foto_Perfil_Top" src="{{asset("assets/back/images/users/usericon.png")}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="profile-pic" />
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                        @if ($datosUsuario->USR_Foto_Perfil_Usuario != null)
                                            <img id="Foto_Perfil_Top_Notif" src="data:image/png;base64, {{$datosUsuario->USR_Foto_Perfil_Usuario}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" />
                                        @else
                                            <img id="Foto_Perfil_Top_Notif" src="{{asset("assets/back/images/users/usericon.png")}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" />
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}</h4>
                                        <br/>
                                        {{--<p class="text-muted"><a href="https://www.wrappixel.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="780e190a0d16381f15191114561b1715">[{{Lang::get('messages.EmailProtected')}}]</a></p>--}}
                                        <a href="{{route('perfil')}}" class="btn btn-rounded btn-danger btn-sm">{{Lang::get('messages.ViewProfile')}}</a>
                                        @if (can2('descargar_app'))
                                            <a href='{{route(can4("descargar_app")->PRM_Accion_Permiso)}}' target="_blank" class="btn btn-rounded btn-danger btn-sm">
                                                {{(Lang::get('messages.'.can4('descargar_app')->PRM_Slug_Permiso) == 'messages.'.can4('descargar_app')->PRM_Slug_Permiso) ? can4('descargar_app')->PRM_Nombre_Permiso : Lang::get('messages.'.can4('descargar_app')->PRM_Slug_Permiso)}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            {{--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>--}}
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> {{Lang::get('messages.Logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                @if (Request::route()->methods[0] != 'POST')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @foreach ($idiomas as $idioma)
                                @if ($idioma->IDM_Short_Alias_Idioma == session()->get('locale'))
                                    <i class="{{$idioma->IDM_Bandera_Idioma}}"></i>
                                @endif
                            @endforeach
                        </a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            @if (config('locale.status') && count(config('locale.languages')) > 1 && !empty($idiomas) && $idiomas->count() > 0)
                                @foreach ($idiomas as $idioma)
                                    <a class="dropdown-item" href="{{route('cambiar_idioma', $idioma->IDM_Short_Alias_Idioma)}}">
                                        <i class="{{$idioma->IDM_Bandera_Idioma}}"></i> {{(Lang::get('messages.'.$idioma->IDM_Nick_Idioma) == 'messages.'.$idioma->IDM_Nick_Idioma) ? $idioma->IDM_Nombre_Idioma : Lang::get('messages.'.$idioma->IDM_Nick_Idioma)}}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>