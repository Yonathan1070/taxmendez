@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Company')}}
@endsection
@section('styles')
    <!-- Cropper CSS -->
    <link href="{{asset('assets/back/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Company')}}</h3>
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
                    <h4 class="card-title m-t-10">
                        {{$empresa->EMP_Nombre_Empresa}}
                    </h4>
                    <span data-toggle="tooltip" title="{{Lang::get('messages.ChangeLogo')}}">
                        @if ($empresa->EMP_Logo_Empresa != null || $empresa->EMP_Logo_Empresa != '')
                            <img id="Logo_Empresa" src="data:image/png;base64, {{$empresa->EMP_Logo_Empresa}}" alt="{{'Logo '.$empresa->EMP_Nombre_Empresa}}" class="img-circle" height="50" onclick="logoClic()" />
                        @else
                            <img id="Logo_Empresa" src="{{asset("assets/back/images/logo-icon.png")}}" alt="{{'Logo '.$empresa->EMP_Nombre_Empresa}}" class="img-circle" height="50" onclick="logoClic()" />
                        @endif
                    </span>
                    <form action="" method="post" style="display: none" id="logoForm" name="logoForm" enctype="multipart/form-data">
                        <input type="file" id="EMP_Logo_Empresa" name="EMP_Logo_Empresa" accept="image/*" />
                    </form>
                
                    <span data-toggle="tooltip" title="{{Lang::get('messages.ChangeLogoTexto')}}">
                        @if ($empresa->EMP_Logo_Texto_Empresa != null || $empresa->EMP_Logo_Texto_Empresa != '')
                            <img id="Logo_Texto_Empresa" src="data:image/png;base64, {{$empresa->EMP_Logo_Texto_Empresa}}" alt="{{'Logo Texto '.$empresa->EMP_Nombre_Empresa}}" class="img-circle" height="50" onclick="logoTextClic()" />
                        @else
                            <img id="Logo_Texto_Empresa" src="{{asset("assets/back/images/logo-text.png")}}" alt="{{'Logo Texto '.$empresa->EMP_Nombre_Empresa}}" class="img-circle" height="50" onclick="logoTextClic()" />
                        @endif
                    </span>
                    <form action="" method="post" style="display: none" id="logoTextoForm" name="logoTextoForm" enctype="multipart/form-data">
                        <input type="file" id="EMP_Logo_Texto_Empresa" name="EMP_Logo_Texto_Empresa" accept="image/*" />
                    </form>
                </center>
            </div>
            <div><hr></div>
            <div class="card-body">
                <small class="text-muted">{{Lang::get('messages.CompanyName')}}</small>
                <h6>{{$empresa->EMP_Nombre_Empresa}}</h6>
                <small class="text-muted p-t-30 db">{{Lang::get('messages.Phone')}}</small>
                <h6>{{$empresa->EMP_Telefono_Empresa}}</h6>
                <small class="text-muted p-t-30 db">{{Lang::get('messages.Address')}}</small>
                <h6>{{$empresa->EMP_Direccion_Empresa}}</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#edit" role="tab">{{Lang::get('messages.EditCompany')}}</a> </li>
                @if ($canalCorreo && $canalCorreo->CNT_Habilitado_Canal_Notificacion)
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#edit_server" role="tab">{{Lang::get('messages.EditServerEmail')}}</a> </li>
                @endif
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- edit tab -->
                <div class="tab-pane active" id="edit" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{route('actualizar_empresa_usuario')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.NIT')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$empresa->EMP_NIT_Empresa}}" class="form-control form-control-line" id="EMP_NIT_Empresa" name="EMP_NIT_Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Name')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$empresa->EMP_Nombre_Empresa}}" class="form-control form-control-line" id="EMP_Nombre_Empresa" name="EMP_Nombre_Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">{{Lang::get('messages.Email')}}</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="{{$empresa->EMP_Correo_Empresa}}" class="form-control form-control-line" id="EMP_Correo_Empresa" name="EMP_Correo_Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Phone')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$empresa->EMP_Telefono_Empresa}}" class="form-control form-control-line" id="EMP_Telefono_Empresa" name="EMP_Telefono_Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">{{Lang::get('messages.Address')}}</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{$empresa->EMP_Direccion_Empresa}}" class="form-control form-control-line" id="EMP_Direccion_Empresa" name="EMP_Direccion_Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">{{Lang::get('messages.updateCompany')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($canalCorreo && $canalCorreo->CNT_Habilitado_Canal_Notificacion)
                    <!-- edit server email tab -->
                    <div class="tab-pane" id="edit_server" role="tabpanel">
                        <div class="card-body">
                            <form class="form-horizontal form-material" action="{{route('actualizar_servidor_correo')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.DriverEmail')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Driver_Servidor : ''}}" class="form-control form-control-line" id="SRC_Driver_Servidor" name="SRC_Driver_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.Host')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Host_Servidor : ''}}" class="form-control form-control-line" id="SRC_Host_Servidor" name="SRC_Host_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">{{Lang::get('messages.Port')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Puerto_Servidor : ''}}" class="form-control form-control-line" id="SRC_Puerto_Servidor" name="SRC_Puerto_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.UserOrEmail')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Nombre_Usuario_Servidor : ''}}" class="form-control form-control-line" id="SRC_Nombre_Usuario_Servidor" name="SRC_Nombre_Usuario_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.Password')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Password_Servidor : ''}}" class="form-control form-control-line" id="SRC_Password_Servidor" name="SRC_Password_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.Encryption')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Encriptacion_Servidor : ''}}" class="form-control form-control-line" id="SRC_Encriptacion_Servidor" name="SRC_Encriptacion_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.FromAddress')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Direccion_De_Servidor : ''}}" class="form-control form-control-line" id="SRC_Direccion_De_Servidor" name="SRC_Direccion_De_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">{{Lang::get('messages.FromEmail')}}</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="{{($servidor) ? $servidor->SRC_Nombre_De_Servidor : ''}}" class="form-control form-control-line" id="SRC_Nombre_De_Servidor" name="SRC_Nombre_De_Servidor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{Lang::get('messages.updateServidor')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
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
        function logoClic(){
            $('#EMP_Logo_Empresa').trigger('click');
        }

        function logoTextClic(){
            $('#EMP_Logo_Texto_Empresa').trigger('click');
        }

        $(function () {
            $("#EMP_Logo_Empresa").on('change', function () {
                form = new FormData();
                form.append('EMP_Logo_Empresa', $('#EMP_Logo_Empresa')[0].files[0]);
                jQuery.ajax({
                    url:"{{route('actualizar_logo_empresa')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data:form,
                    method:"POST",
                    processData: false,
                    contentType: false,
                    success:function(data){  
                        if(data.success){
                            document.getElementById('Logo').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            document.getElementById('Logo_Empresa').setAttribute(
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

            $("#EMP_Logo_Texto_Empresa").on('change', function () {
                form = new FormData();
                form.append('EMP_Logo_Texto_Empresa', $('#EMP_Logo_Texto_Empresa')[0].files[0]);
                jQuery.ajax({
                    url:"{{route('actualizar_logo_texto_empresa')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data:form,
                    method:"POST",
                    processData: false,
                    contentType: false,
                    success:function(data){  
                        if(data.success){
                            document.getElementById('Logo_Texto').setAttribute(
                                'src', 'data:image/png;base64,'+data.image
                            );
                            document.getElementById('Logo_Texto_Empresa').setAttribute(
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