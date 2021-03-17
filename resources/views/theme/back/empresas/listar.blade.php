@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Companies')}}
@endsection
@section('styles')
    
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Companies')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_empresa'))
                    <a class="mytooltip" href="{{route('crear_empresa')}}">
                        <i class="ti-plus"></i>
                        <span class="tooltip-content3">
                            {{Lang::get('messages.AddCompany')}}
                        </span>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.CompanyList')}}</h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <div class="table-responsive m-t-40">
                <table class="table table-bordered table-striped myTable">
                    <thead>
                        <tr>
                            <th>{{Lang::get('messages.NIT')}}</th>
                            <th>{{Lang::get('messages.CompanyName')}}</th>
                            <th>{{Lang::get('messages.Logo')}}</th>
                            @if (can2('editar_empresa'))
                                <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                            <tr>
                                <td>{{$empresa->EMP_NIT_Empresa}}</td>
                                <td>{{$empresa->EMP_Nombre_Empresa}}</td>
                                <td>
                                    @if ($empresa->EMP_Logo_Empresa != null || $empresa->EMP_Logo_Empresa != '')
                                        <img id="LogoCompany" src="data:image/png;base64, {{$empresa->EMP_Logo_Empresa}}" alt="{{'Logo '.$empresa->EMP_Nombre_Empresa}}" />
                                    @endif
                                </td>
                                @if (can2('editar_empresa'))
                                    <td>
                                        <a class="mytooltip" href="{{route('editar_empresa', ['id'=>Crypt::encrypt($empresa->id)])}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditCompany')}} {{$empresa->EMP_Nombre_Empresa}}
                                            </span>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptsPlugins')
    
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/general.js')}}"></script>
@endsection