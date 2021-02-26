@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Profile')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Profile')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <x-alert tipo="danger" :mensaje="$errors" />
                @endif
                @if (session('mensaje'))
                    <x-alert tipo="success" :mensaje="session('mensaje')" />
                @endif
                <center class="m-t-30">
                    @if ($datosUsuario->USR_Foto_Perfil_Usuario != null)
                        <img src="data:image/png;base64, {{$datosUsuario->USR_Foto_Perfil_Usuario}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="img-circle" width="150" />
                    @else
                        <img src="{{asset("assets/back/images/users/usericon.png")}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="img-circle" width="150" />
                    @endif
                    <h4 class="card-title m-t-10">
                        {{$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}
                    </h4>
                    {{--<h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                    </div>--}}
                </center>
            </div>
            <div><hr></div>
            <div class="card-body">
                <small class="text-muted">{{Lang::get('messages.UserName')}}</small>
                <h6>{{$datosUsuario->USR_Nombre_Usuario}}</h6>
                <small class="text-muted p-t-30 db">{{Lang::get('messages.Phone')}}</small>
                <h6>{{$datosUsuario->USR_Telefono_Usuario}}</h6>
                <small class="text-muted p-t-30 db">{{Lang::get('messages.Address')}}</small>
                <h6>{{$datosUsuario->USR_Direccion_Residencia_Usuario}}</h6>
                {{--<small class="text-muted p-t-30 db">Social Profile</small>
                <br/>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>--}}
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">{{Lang::get('messages.Profile')}}</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#edit" role="tab">{{Lang::get('messages.EditProfile')}}</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab">{{Lang::get('messages.ChangePassword')}}</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--first tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>{{Lang::get('messages.FullName')}}</strong>
                                <br>
                                <p class="text-muted">{{$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>{{Lang::get('messages.Phone')}}</strong>
                                <br>
                                <p class="text-muted">{{$datosUsuario->USR_Telefono_Usuario}}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>{{Lang::get('messages.Email')}}</strong>
                                <br>
                                <p class="text-muted">{{$datosUsuario->USR_Correo_Usuario}}</p>
                            </div>
                            {{--<div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                <br>
                                <p class="text-muted">London</p>
                            </div>--}}
                        </div>
                        <hr>
                        {{--<p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <h4 class="font-medium m-t-30">Skill Set</h4>
                        <hr>
                        <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>--}}
                    </div>
                </div>
                <!-- second tab -->
                <div class="tab-pane" id="edit" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{route('actualizar_perfil')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Name')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$datosUsuario->USR_Nombres_Usuario}}" class="form-control form-control-line" id="USR_Nombres_Usuario" name="USR_Nombres_Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.LastName')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$datosUsuario->USR_Apellidos_Usuario}}" class="form-control form-control-line" id="USR_Apellidos_Usuario" name="USR_Apellidos_Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">{{Lang::get('messages.Email')}}</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="{{$datosUsuario->USR_Correo_Usuario}}" class="form-control form-control-line" id="USR_Correo_Usuario" name="USR_Correo_Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Phone')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$datosUsuario->USR_Telefono_Usuario}}" class="form-control form-control-line" id="USR_Telefono_Usuario" name="USR_Telefono_Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Address')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$datosUsuario->USR_Direccion_Residencia_Usuario}}" class="form-control form-control-line" id="USR_Direccion_Residencia_Usuario" name="USR_Direccion_Residencia_Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">{{Lang::get('messages.updateProfile')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- third tab -->
                <div class="tab-pane" id="password" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{route('actualizar_contrasena')}}" method="POST" novalidate>
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.OldPassword')}}</label>
                                <div class="col-md-12 controls">
                                    <input type="password" placeholder="{{Lang::get('messages.OldPassword')}}" class="form-control form-control-line" required id="OldPsw" name="OldPsw" data-validation-required-message="{{Lang::get('messages.Required')}}" pattern="(?=.*?[a-z])([a-zA-Z0-9!#$%&/()=?¡\\¿¨´*+~{}^`,;.:_-]{7,})" data-validation-pattern-message="{{Lang::get('messages.RegexPassword')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.NewPassword')}}</label>
                                <div class="col-md-12 controls">
                                    <input type="password" placeholder="{{Lang::get('messages.NewPassword')}}" class="form-control form-control-line" required id="NewPsw" name="NewPsw" data-validation-required-message="{{Lang::get('messages.Required')}}" pattern="(?=.*?[a-z])([a-zA-Z0-9!#$%&/()=?¡\\¿¨´*+~{}^`,;.:_-]{7,})" data-validation-pattern-message="{{Lang::get('messages.RegexPassword')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.RetypePassword')}}</label>
                                <div class="col-md-12 controls">
                                    <input type="password" placeholder="{{Lang::get('messages.RetypePassword')}}" class="form-control form-control-line" required id="RetPsw" name="RetPsw" data-validation-required-message="{{Lang::get('messages.Required')}}" pattern="(?=.*?[a-z])([a-zA-Z0-9!#$%&/()=?¡\\¿¨´*+~{}^`,;.:_-]{7,})" data-validation-pattern-message="{{Lang::get('messages.RegexPassword')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">{{Lang::get('messages.updatePassword')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script src="{{asset("assets/back/js/validation.js")}}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
        }(window, document, jQuery);
    </script>
@endsection