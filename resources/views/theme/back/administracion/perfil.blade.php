@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Profile')}}
@endsection
@section('styles')
    <!-- Cropper CSS -->
    <link href="{{asset('assets/back/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
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
                    <span data-toggle="tooltip" title="{{Lang::get('messages.ChangeImage')}}">
                        @if ($datosUsuario->USR_Foto_Perfil_Usuario != null)
                            <img id="Foto_Perfil" src="data:image/png;base64, {{$datosUsuario->USR_Foto_Perfil_Usuario}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="img-circle" width="150" onclick="imageClic()" />
                        @else
                            <img id="Foto_Perfil" src="{{asset("assets/back/images/users/usericon.png")}}" alt="{{'Foto '.$datosUsuario->USR_Nombres_Usuario.' '.$datosUsuario->USR_Apellidos_Usuario}}" class="img-circle" width="150" onclick="imageClic()" />
                        @endif
                    </span>
                    <form action="" method="post" style="display: none" id="fotoForm" name="fotoForm" enctype="multipart/form-data">
                        <input type="file" id="USR_Foto_Perfil_Usuario" name="USR_Foto_Perfil_Usuario" accept="image/*" />
                    </form>
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
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#alerts" role="tab">{{Lang::get('messages.Alerts')}}</a> </li>
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
                <!-- alerts tab -->
                <div class="tab-pane" id="alerts" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{route('guardar_alertas_usuario')}}" method="POST" novalidate>
                            @csrf
                            <div class="demo-checkbox">
                                @foreach ($canalesAsignados as $canal)
                                    <input type="checkbox" id="cbx_{{$canal->id}}" name="cbx_{{$canal->id}}" checked />
                                    <label for="cbx_{{$canal->id}}">
                                        {{(Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion) == 'messages.'.$canal->CNT_Nick_Canal_Notificacion) ? $canal->CNT_Nombre_Canal_Notificacion : Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion)}}
                                    </label>
                                @endforeach
                                @foreach ($canalesNoAsignados as $canal)
                                    <input type="checkbox" id="cbx_{{$canal->id}}" name="cbx_{{$canal->id}}" />
                                    <label for="cbx_{{$canal->id}}">
                                        {{(Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion) == 'messages.'.$canal->CNT_Nick_Canal_Notificacion) ? $canal->CNT_Nombre_Canal_Notificacion : Lang::get('messages.'.$canal->CNT_Nick_Canal_Notificacion)}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-editor" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Editor de imagen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- .Your image -->
                            <div class="col-md-9 p-20">
                                <div class="img-container">
                                    <img id="imageEditor" src="{{asset('assets/back/images/big/img2.jpg')}}" class="img-responsive" alt="EditorImage">
                                </div>
                            </div>
                            <!-- /.Your image -->
                            <!-- .Croping image -->
                            <div class="col-md-3">
                                <!-- <h3>Preview:</h3> -->
                                <div class="docs-preview clearfix">
                                    <div class="img-preview preview-lg"></div>
                                    <div class="img-preview preview-md"></div>
                                    <div class="img-preview preview-sm"></div>
                                    <div class="img-preview preview-xs"></div>
                                </div>
                                <!-- <h3>Data:</h3> -->
                                <div class="docs-data">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataX">{{Lang::get('messages.X')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataX" placeholder="{{Lang::get('messages.X')}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{Lang::get('messages.px')}}</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataY">{{lang::get('messages.Y')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataY" placeholder="{{lang::get('messages.Y')}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{Lang::get('messages.px')}}</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataWidth">{{Lang::get('messages.Width')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataWidth" placeholder="{{Lang::get('messages.Width')}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{Lang::get('messages.px')}}</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataHeight">{{Lang::get('messages.Height')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataHeight" placeholder="{{Lang::get('messages.Height')}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{Lang::get('messages.px')}}</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataRotate">{{Lang::get('messages.Rotate')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataRotate" placeholder="{{Lang::get('messages.Rotate')}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{Lang::get('messages.Degree')}}</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataScaleX">{{Lang::get('messages.ScaleX')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataScaleX" placeholder="{{Lang::get('messages.ScaleX')}}">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataScaleY">{{Lang::get('messages.ScaleY')}}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataScaleY" placeholder="{{Lang::get('messages.ScaleY')}}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.Croping of image -->
                        </div>

                        <div class="row">
                            <div class="col-md-9 docs-buttons">
                                <!-- .btn groups -->
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('setDragMode', 'move')" class="btn btn-info"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Move')}}"> <span class="fas fa-arrows-alt"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('setDragMode', 'crop')" class="btn btn-info"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Crop')}}"> <span class="fa fa-crop"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('zoom', '0.1')" class="btn btn-success"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.ZoomIn')}}"> <span class="fa fa-search-plus"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('zoom', '-0.1')" class="btn btn-success"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.ZoomOut')}}"> <span class="fa fa-search-minus"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('move', '-10', '0')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.MoveLeft')}}"> <span class="fa fa-arrow-left"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('move', '10', '0')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.MoveRight')}}"> <span class="fa fa-arrow-right"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('move', '0', '-10')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.MoveUp')}}"> <span class="fa fa-arrow-up"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('move', '0', '10')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.MoveDown')}}"> <span class="fa fa-arrow-down"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('rotate', '-45')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Rotate45')}}"> <span class="fas fa-undo"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('rotate', '-180')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Rotate180')}}"> <span class="fas fa-sync-alt"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('scaleX', -1)" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.FlipHorizontal')}}"> <span class="fas fa-arrows-alt-h"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('scaleY', -1)" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.FlipVertical')}}"> <span class="fas fa-arrows-alt-v"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('disable')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Disable')}}"> <span class="fa fa-lock"></span> </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('enable')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Enable')}}"> <span class="fa fa-unlock"></span> </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" onclick="changeMethod('reset')" class="btn btn-secondary btn-outline"> <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Reset')}}"> <span class="fas fa-sync-alt"></span> </span>
                                    </button>
                                    <label class="btn btn-secondary btn-outline btn-upload" for="inputImage">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.UploadImage')}}"> <span class="fa fa-upload"></span> </span>
                                    </label>
                                </div>
                            </div>
                            <!-- /.btn groups -->
                            <div class="col-md-3 docs-toggles">
                                <!-- .btn groups -->
                                <div class="btn-group btn-group-justified" data-toggle="buttons">
                                    <button type="button" onclick="changeMethod('aspectRatio', 'NaN')" class="btn btn-secondary btn-outline">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.Free')}}">
                                            {{Lang::get('messages.Free')}}
                                        </span>
                                    </button>
                                    <button type="button" onclick="changeMethod('aspectRatio', '1')" class="btn btn-secondary btn-outline">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="{{Lang::get('messages.1_1')}}">
                                            {{Lang::get('messages.1_1')}}
                                        </span>
                                    </button>
                                </div>
                                <!-- /.btn groups -->
                            </div>
                            <!-- /.btn groups -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                        <button type="button" onclick="changeMethod('getCroppedCanvas')" class="btn btn-danger waves-effect waves-light">{{Lang::get('messages.Save')}}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- Column -->
@endsection
@section('scriptsPlugins')
    <!-- Image cropper JavaScript -->
    <script src="{{asset('assets/back/plugins/cropper/cropper.min.js')}}"></script>
    <script src="{{asset('assets/back/plugins/cropper/cropper.perfil.init.js')}}"></script>
@endsection
@section('scripts')
    <script src="{{asset("assets/back/js/validation.js")}}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
        }(window, document, jQuery);
    </script>
    <script>
        function imageClic(){
            $('#USR_Foto_Perfil_Usuario').trigger('click');
        }

        $(function () {
            $("#USR_Foto_Perfil_Usuario").on('change', function () {
                form = new FormData();
                form.append('USR_Foto_Perfil_Usuario', $('#USR_Foto_Perfil_Usuario')[0].files[0]);
                jQuery.ajax({
                    url:"foto-perfil",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data:form,
                    method:"POST",
                    processData: false,
                    contentType: false,
                    success:function(data){  
                        if(data.success){
                            document.getElementById('Foto_Perfil_Top').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            document.getElementById('Foto_Perfil_Top_Notif').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            document.getElementById('Foto_Perfil_Aside').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            document.getElementById('Foto_Perfil').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            taxmendez.notificaciones(data.message, data.title, data.type);
                        }else{
                            if(data.image != null){
                                document.getElementById('imageEditor').setAttribute(
                                    'src', 'data:image/png;base64,'+data.image
                                );
                                $('#imageEditor').cropper('destroy').cropper('crop');
                                $('#modal-editor').modal('show');
                            }
                            taxmendez.notificaciones(data.message, data.title, data.type);
                        }
                    },
                    error:function(error){
                        taxmendez.notificaciones(data.message, data.title, data.type);
                    }
                });
            });
        });
    </script>
@endsection