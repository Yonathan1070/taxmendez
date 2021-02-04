@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Automobiles')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('automoviles')}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.OwnersList')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <form class="m-t-40" action="{{route('guardar_asignacion_automovil', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST" novalidate>
                @csrf
                <div class="row el-element-overlay">
                    @foreach ($usuariosArr as $usuario)
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7IQXBpx16Y8A8u-6b0rBbIdmHAaSpHxgt-g&usqp=CAU" alt="{{$usuario['USR_Nombres_Usuario']}}" />
                                        <div class="el-overlay scrl-up">
                                            <ul class="el-info">
                                                <li>
                                                    <a class="btn default btn-outline image-popup-vertical-fit" href="javascript:void(0);"><i class="icon-magnifier"></i></a>
                                                </li>
                                                <li>
                                                    <a class="btn default btn-outline" href="javascript:void(0);" onclick="asignar({{$usuario['id']}})">
                                                        <i id="iconCheck_{{$usuario['id']}}" class="icon-{{$usuario['AUT_PRP_Propietario_Id'] == $usuario['id'] ? 'check' : 'close'}}"></i>
                                                    </a>
                                                    <input type="checkbox" id="cbx_{{$usuario['id']}}" name="cbx_{{$usuario['id']}}" {{$usuario['AUT_PRP_Propietario_Id'] == $usuario['id'] ? "checked" : ""}} />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <h3 class="box-title">{{$usuario['USR_Apellidos_Usuario']}}</h3>
                                        <small>{{$usuario['USR_Nombres_Usuario']}}</small>
                                        <br/> </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-xs-right">
                    <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
                    <a href="{{route('automoviles')}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script>
        function asignar(id) {
            var checkBox = document.getElementById("cbx_"+id);
            
            var icon = document.getElementById("iconCheck_"+id);
          
            if (checkBox.checked == true){
                checkBox.checked = false;
                icon.removeAttribute("class");
                icon.className = "icon-close";
            } else {
                checkBox.checked = true;
                icon.removeAttribute("class");
                icon.className = "icon-check";
            }
          }
          
    </script>
@endsection