@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Icons')}}
@endsection
@section('styles')
    <style>
        .material-icon-list-demo .icons div{
            width: 4%;
        }
    </style>
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Icons')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="javascript:cerrar();" >
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.Icons')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            <div class="table-responsive m-t-40">
                <div id="accordian-3">
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseMaterial" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">
                                    Material Icons
                                </h5>
                            </button>
                        </a>
                        <div id="collapseMaterial" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                            <div class="card-body">
                                <div class="material-icon-list-demo">
                                    <div class="icons" id="icons">
                                        @foreach ($material as $icon)
                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFontAwesome" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">
                                    FontAwesome Icons
                                </h5>
                            </button>
                        </a>
                        <div id="collapseFontAwesome" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                            <div class="card-body">
                                <div id="accordian-4">
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFASolid" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Solid
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseFASolid" class="collapse" aria-labelledby="heading11" data-parent="#accordian-4">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($fa_solid as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFARegular" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Regular
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseFARegular" class="collapse" aria-labelledby="heading11" data-parent="#accordian-4">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($fa_regular as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFABrand" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Brand
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseFABrand" class="collapse" aria-labelledby="heading11" data-parent="#accordian-4">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($fa_brand as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseThemify" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">
                                    Themify Icons
                                </h5>
                            </button>
                        </a>
                        <div id="collapseThemify" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                            <div class="card-body">
                                <div id="accordian-5">
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiArrows" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Solid
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiArrows" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_arrow as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiApp" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Web App
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiApp" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_app as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiControl" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Control
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiControl" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_control as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiTextEditor" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Text Editor
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiTextEditor" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_text_editor as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiLayout" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Layout
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiLayout" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_layout as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTiBrand" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="m-b-0">
                                                    Brand
                                                </h5>
                                            </button>
                                        </a>
                                        <div id="collapseTiBrand" class="collapse" aria-labelledby="heading11" data-parent="#accordian-5">
                                            <div class="card-body">
                                                <div class="material-icon-list-demo">
                                                    <div class="icons" id="icons">
                                                        @foreach ($ti_brand as $icon)
                                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseControl" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">
                                    Control Icons
                                </h5>
                            </button>
                        </a>
                        <div id="collapseControl" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                            <div class="card-body">
                                <div class="material-icon-list-demo">
                                    <div class="icons" id="icons">
                                        @foreach ($control as $icon)
                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading11" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFlag" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">
                                    Flag Icons
                                </h5>
                            </button>
                        </a>
                        <div id="collapseFlag" class="collapse" aria-labelledby="heading11" data-parent="#accordian-3">
                            <div class="card-body">
                                <div class="material-icon-list-demo">
                                    <div class="icons" id="icons">
                                        @foreach ($flag as $icon)
                                            <div><a class="btn btn-light" onclick="copiar('{{$icon}}')"><i class="{{$icon}}"></i></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script>
        function copiar(icon) {
            if(icon.includes("flag")){
                icon = "flag "+icon;
            }
            // Crea un campo de texto "oculto"
            var aux = document.createElement("input");
            // Asigna el contenido del elemento especificado al valor del campo
            aux.setAttribute("value", icon);
            // Añade el campo a la página
            document.body.appendChild(aux);
            // Selecciona el contenido del campo
            aux.select();
            // Copia el texto seleccionado
            document.execCommand("copy");
            // Elimina el campo de la página
            document.body.removeChild(aux);

            taxmendez.notificaciones('Elemento copiado al portapaeles', 'TaxMendez', 'success');
        }

        function cerrar() { 
            window.open('','_parent',''); 
            window.close(); 
         }          
    </script>
@endsection