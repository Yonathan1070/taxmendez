@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <style>
        .verticalText {
            writing-mode: vertical-lr;
            transform: rotate(180deg);
        }
        table {border:1px solid red; border-bottom:0; text-align: center;}
    </style>
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Automobiles')}}</h3>
    </div>
    @include('theme.back.automoviles.meses')
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                <a class="mytooltip" href="{{route('balance', ['id'=>Crypt::encrypt($automovil->id)])}}">
                    <i class="ti-arrow-left"></i>
                    <span class="tooltip-content3">
                        {{Lang::get('messages.Back')}}
                    </span>
                </a>
            </div>
            <h4 class="card-title m-b-0">
                {{Lang::get('messages.Monthly')}} Taxi {{$automovil->AUT_Numero_Interno_Automovil}}   /   {{Lang::get('messages.'.Carbon\Carbon::parse('01-'.$fechaMes)->format('F')).' '.Carbon\Carbon::parse('01-'.$fechaMes)->format('Y')}}
            </h4>
        </div>
        <div class="card-body collapse show b-t">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            @if (session('mensaje'))
                <x-alert tipo="success" :mensaje="session('mensaje')" />
            @endif
            <?php 
                $mesMensualidad = str_split(Str::upper(Lang::get('messages.'.Carbon\Carbon::parse('01-'.$fechaMes)->format('F')).' '.Carbon\Carbon::parse('01-'.$fechaMes)->format('Y')));
                $totales = [];
            ?>
            <div class="row">
                <div class="col-12 m-t-30" style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
                    <div class="card-group">
                        <div class="col-md-5" style="padding-right: 0px; padding-left: 0px;">
                            <div class="card">
                                <div class="card-body" style="padding: 0;">
                                    <div class="table-responsive m-t-40">
                                        <table border="1" style="width: 100%;">
                                            <tr>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Month')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">#</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.dia')}}</td>
                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoUno) ? $conductorFijoUno->USR_Nombres_Usuario : '-'}}</td>
                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoDos) ? $conductorFijoDos->USR_Nombres_Usuario : '-'}}</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="33" style="font-size: 30px;">
                                                    @foreach ($mesMensualidad as $caracter)
                                                        {{$caracter}}<br />
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[0][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[0][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[0][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : $dias[0][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : (($dias[0][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[0][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[0]) == 0) ? '-' : $dias[0][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[0]) == 0) ? '-' : '$'.number_format($dias[0][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[0]) == 0) ? '-' : '$'.number_format($dias[0][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[1][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[1][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[1][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : $dias[1][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : (($dias[1][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[1][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[1]) == 0) ? '-' : $dias[1][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[1]) == 0) ? '-' : '$'.number_format($dias[1][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[1]) == 0) ? '-' : '$'.number_format($dias[1][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[2][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[2][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[2][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : $dias[2][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : (($dias[2][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[2][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[2]) == 0) ? '-' : $dias[2][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[2]) == 0) ? '-' : '$'.number_format($dias[2][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[2]) == 0) ? '-' : '$'.number_format($dias[2][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[3][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[3][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[3][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : $dias[3][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : (($dias[3][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[3][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[3]) == 0) ? '-' : $dias[3][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[3]) == 0) ? '-' : '$'.number_format($dias[3][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[3]) == 0) ? '-' : '$'.number_format($dias[3][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[4][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[4][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[4][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : $dias[4][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : (($dias[4][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[4][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[4]) == 0) ? '-' : $dias[4][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[4]) == 0) ? '-' : '$'.number_format($dias[4][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[4]) == 0) ? '-' : '$'.number_format($dias[4][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[5][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[5][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[5][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : $dias[5][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : (($dias[5][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[5][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[5]) == 0) ? '-' : $dias[5][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[5]) == 0) ? '-' : '$'.number_format($dias[5][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[5]) == 0) ? '-' : '$'.number_format($dias[5][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[6][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[6][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[6][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : $dias[6][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : (($dias[6][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[6][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[6]) == 0) ? '-' : $dias[6][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[6]) == 0) ? '-' : '$'.number_format($dias[6][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[6]) == 0) ? '-' : '$'.number_format($dias[6][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[7][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[7][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[7][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : $dias[7][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : (($dias[7][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[7][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[7]) == 0) ? '-' : $dias[7][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[7]) == 0) ? '-' : '$'.number_format($dias[7][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[7]) == 0) ? '-' : '$'.number_format($dias[7][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[8][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[8][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[8][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : $dias[8][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : (($dias[8][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[8][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[8]) == 0) ? '-' : $dias[8][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[8]) == 0) ? '-' : '$'.number_format($dias[8][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[8]) == 0) ? '-' : '$'.number_format($dias[8][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[9][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[9][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[9][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : $dias[9][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : (($dias[9][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[9][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[9]) == 0) ? '-' : $dias[9][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[9]) == 0) ? '-' : '$'.number_format($dias[9][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[9]) == 0) ? '-' : '$'.number_format($dias[9][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[10][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[10][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[10][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : $dias[10][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : (($dias[10][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[10][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[10]) == 0) ? '-' : $dias[10][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[10]) == 0) ? '-' : '$'.number_format($dias[10][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[10]) == 0) ? '-' : '$'.number_format($dias[10][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[11][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[11][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[11][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : $dias[11][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : (($dias[11][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[11][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[11]) == 0) ? '-' : $dias[11][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[11]) == 0) ? '-' : '$'.number_format($dias[11][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[11]) == 0) ? '-' : '$'.number_format($dias[11][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[12][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[12][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[12][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : $dias[12][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : (($dias[12][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[12][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[12]) == 0) ? '-' : $dias[12][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[12]) == 0) ? '-' : '$'.number_format($dias[12][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[12]) == 0) ? '-' : '$'.number_format($dias[12][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[13][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[13][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[13][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : $dias[13][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : (($dias[13][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[13][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[13]) == 0) ? '-' : $dias[13][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[13]) == 0) ? '-' : '$'.number_format($dias[13][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[13]) == 0) ? '-' : '$'.number_format($dias[13][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[14][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[14][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[14][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : $dias[14][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : (($dias[14][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[14][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[14]) == 0) ? '-' : $dias[14][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[14]) == 0) ? '-' : '$'.number_format($dias[14][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[14]) == 0) ? '-' : '$'.number_format($dias[14][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    {{
                                                        '$'.number_format(
                                                            (
                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][0]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][0]->TRN_AUT_Producido_Turno))
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        number_format(
                                                            (
                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][0]->TRN_AUT_Kilometros_Andados_Turno))
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        '$'.number_format(
                                                            (
                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][1]->TRN_AUT_Producido_Turno) + 
                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][1]->TRN_AUT_Producido_Turno))
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        number_format(
                                                            (
                                                                (((sizeof($dias[0]) == 0) ? 0 : $dias[0][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[1]) == 0) ? 0 : $dias[1][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[2]) == 0) ? 0 : $dias[2][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[3]) == 0) ? 0 : $dias[3][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[4]) == 0) ? 0 : $dias[4][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[5]) == 0) ? 0 : $dias[5][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[6]) == 0) ? 0 : $dias[6][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[7]) == 0) ? 0 : $dias[7][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[8]) == 0) ? 0 : $dias[8][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[9]) == 0) ? 0 : $dias[9][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[10]) == 0) ? 0 : $dias[10][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[11]) == 0) ? 0 : $dias[11][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[12]) == 0) ? 0 : $dias[12][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[13]) == 0) ? 0 : $dias[13][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                ((sizeof($dias[14]) == 0) ? 0 : $dias[14][1]->TRN_AUT_Kilometros_Andados_Turno))
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" style="padding-right: 0px; padding-left: 0px;">
                            <div class="card">
                                <div class="card-body" style="padding: 0;">
                                    <div class="table-responsive m-t-40">
                                        <table border="1" style="width: 100%;">
                                            <tr>
                                                <td rowspan="2" style="display: none;">{{Lang::get('messages.Month')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">#</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.dia')}}</td>
                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                                <td>{{Lang::get('messages.Driver')}}</td>
                                                <td rowspan="2" style="border:1px solid red;">{{Lang::get('messages.Mileage')}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoUno) ? $conductorFijoUno->USR_Nombres_Usuario : '-'}}</td>
                                                <td style="border:1px solid red; border-top:0; color: red;">{{($conductorFijoDos) ? $conductorFijoDos->USR_Nombres_Usuario : '-'}}</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="33" style="display: none;"><p class="verticalText">Diciembre 2020</p></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[15][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[15][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[15][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : $dias[15][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : (($dias[15][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[15][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[15]) == 0) ? '-' : $dias[15][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[15]) == 0) ? '-' : '$'.number_format($dias[15][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[15]) == 0) ? '-' : '$'.number_format($dias[15][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[16][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[16][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[16][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : $dias[16][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : (($dias[16][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[16][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[16]) == 0) ? '-' : $dias[16][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[16]) == 0) ? '-' : '$'.number_format($dias[16][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[16]) == 0) ? '-' : '$'.number_format($dias[16][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[17][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[17][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[17][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : $dias[17][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : (($dias[17][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[17][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[17]) == 0) ? '-' : $dias[17][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[17]) == 0) ? '-' : '$'.number_format($dias[17][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[17]) == 0) ? '-' : '$'.number_format($dias[17][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[18][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[18][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[18][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : $dias[18][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : (($dias[18][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[18][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[18]) == 0) ? '-' : $dias[18][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[18]) == 0) ? '-' : '$'.number_format($dias[18][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[18]) == 0) ? '-' : '$'.number_format($dias[18][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[19][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[19][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[19][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : $dias[19][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : (($dias[19][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[19][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[19]) == 0) ? '-' : $dias[19][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[19]) == 0) ? '-' : '$'.number_format($dias[19][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[19]) == 0) ? '-' : '$'.number_format($dias[19][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[20][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[20][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[20][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : $dias[20][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : (($dias[20][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[20][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[20]) == 0) ? '-' : $dias[20][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[20]) == 0) ? '-' : '$'.number_format($dias[20][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[20]) == 0) ? '-' : '$'.number_format($dias[20][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[21][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[21][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[21][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : $dias[21][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : (($dias[21][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[21][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[21]) == 0) ? '-' : $dias[21][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[21]) == 0) ? '-' : '$'.number_format($dias[21][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[21]) == 0) ? '-' : '$'.number_format($dias[21][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[22][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[22][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[22][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : $dias[22][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : (($dias[22][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[22][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[22]) == 0) ? '-' : $dias[22][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[22]) == 0) ? '-' : '$'.number_format($dias[22][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[22]) == 0) ? '-' : '$'.number_format($dias[22][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[23][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[23][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[23][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : $dias[23][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : (($dias[23][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[23][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[23]) == 0) ? '-' : $dias[23][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[23]) == 0) ? '-' : '$'.number_format($dias[23][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[23]) == 0) ? '-' : '$'.number_format($dias[23][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[24][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[24][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[24][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : $dias[24][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : (($dias[24][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[24][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[24]) == 0) ? '-' : $dias[24][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[24]) == 0) ? '-' : '$'.number_format($dias[24][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[24]) == 0) ? '-' : '$'.number_format($dias[24][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[25][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[25][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[25][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : $dias[25][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : (($dias[25][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[25][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[25]) == 0) ? '-' : $dias[25][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[25]) == 0) ? '-' : '$'.number_format($dias[25][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[25]) == 0) ? '-' : '$'.number_format($dias[25][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[26][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[26][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[26][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : $dias[26][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : (($dias[26][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[26][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[26]) == 0) ? '-' : $dias[26][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[26]) == 0) ? '-' : '$'.number_format($dias[26][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[26]) == 0) ? '-' : '$'.number_format($dias[26][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[27][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[27][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[27][0]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : $dias[27][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                                <td style="color: red;">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : (($dias[27][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[27][1]->USR_Nombres_Usuario)}}
                                                </td>
                                                <td rowspan="2">
                                                    {{(sizeof($dias[27]) == 0) ? '-' : $dias[27][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{(sizeof($dias[27]) == 0) ? '-' : '$'.number_format($dias[27][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                                <td>
                                                    {{(sizeof($dias[27]) == 0) ? '-' : '$'.number_format($dias[27][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                </td>
                                            </tr>
                                            @if (sizeof($dias) > $cantidadFebrero)
                                                <tr>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[28][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[28][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                    </td>
                                                    <td style="color: red;">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : (($dias[28][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[28][0]->USR_Nombres_Usuario)}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : $dias[28][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                    </td>
                                                    <td style="color: red;">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : (($dias[28][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[28][1]->USR_Nombres_Usuario)}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[28]) == 0) ? '-' : $dias[28][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{(sizeof($dias[28]) == 0) ? '-' : '$'.number_format($dias[28][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                    </td>
                                                    <td>
                                                        {{(sizeof($dias[28]) == 0) ? '-' : '$'.number_format($dias[28][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[29][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[29][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                    </td>
                                                    <td style="color: red;">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : (($dias[29][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[29][0]->USR_Nombres_Usuario)}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : $dias[29][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                    </td>
                                                    <td style="color: red;">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : (($dias[29][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[29][1]->USR_Nombres_Usuario)}}
                                                    </td>
                                                    <td rowspan="2">
                                                        {{(sizeof($dias[29]) == 0) ? '-' : $dias[29][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{(sizeof($dias[29]) == 0) ? '-' : '$'.number_format($dias[29][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                    </td>
                                                    <td>
                                                        {{(sizeof($dias[29]) == 0) ? '-' : '$'.number_format($dias[29][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                    </td>
                                                </tr>
                                                @if (sizeof($dias) > 30)
                                                    <tr>
                                                        <td rowspan="2">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : \Carbon\Carbon::createFromFormat('Y-m-d', $dias[30][0]->TRN_AUT_Fecha_Turno)->format('d')}}
                                                        </td>
                                                        <td rowspan="2">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : Lang::get('messages.'.\Carbon\Carbon::createFromFormat('Y-m-d', $dias[30][0]->TRN_AUT_Fecha_Turno)->format('l'))}}
                                                        </td>
                                                        <td style="color: red;">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : (($dias[30][0]->USR_Nombres_Usuario == $conductorFijoUno->USR_Nombres_Usuario) ? '-' : $dias[30][0]->USR_Nombres_Usuario)}}
                                                        </td>
                                                        <td rowspan="2">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : $dias[30][0]->TRN_AUT_Kilometros_Andados_Turno}}
                                                        </td>
                                                        <td style="color: red;">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : (($dias[30][1]->USR_Nombres_Usuario == $conductorFijoDos->USR_Nombres_Usuario) ? '-' : $dias[30][1]->USR_Nombres_Usuario)}}
                                                        </td>
                                                        <td rowspan="2">
                                                            {{(sizeof($dias[30]) == 0) ? '-' : $dias[30][1]->TRN_AUT_Kilometros_Andados_Turno}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            {{(sizeof($dias[30]) == 0) ? '-' : '$'.number_format($dias[30][0]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                        </td>
                                                        <td>
                                                            {{(sizeof($dias[30]) == 0) ? '-' : '$'.number_format($dias[30][1]->TRN_AUT_Producido_Turno, 0, ',', '.')}}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            <tr>
                                                <td rowspan="2"></td>
                                                <td rowspan="2"></td>
                                                <td rowspan="2">
                                                    {{
                                                        '$'.number_format(
                                                            (
                                                                (
                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][0]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][0]->TRN_AUT_Producido_Turno) +
                                                                    (
                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][0]->TRN_AUT_Producido_Turno) +
                                                                            (
                                                                                (sizeof($dias) > 30) ? (
                                                                                    ((sizeof($dias[29]) == 0) ? 0 : $dias[29][0]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[30]) == 0) ? 0 : $dias[30][0]->TRN_AUT_Producido_Turno)
                                                                                ) : 0
                                                                            )
                                                                        ) : 0
                                                                    )
                                                                )
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td style="color: red;">{{($cadaConductor == 0) ? '-' : $cadaConductor}}</td>
                                                <td rowspan="2">
                                                    {{
                                                        '$'.number_format(
                                                            (
                                                                (
                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][1]->TRN_AUT_Producido_Turno) + 
                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][1]->TRN_AUT_Producido_Turno) +
                                                                    (
                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][1]->TRN_AUT_Producido_Turno) +
                                                                            (
                                                                                (sizeof($dias) > 30) ? (
                                                                                    ((sizeof($dias[29]) == 0) ? 0 : $dias[29][1]->TRN_AUT_Producido_Turno) + 
                                                                                    ((sizeof($dias[30]) == 0) ? 0 : $dias[30][1]->TRN_AUT_Producido_Turno)
                                                                                ) : 0
                                                                            )
                                                                        ) : 0
                                                                    )
                                                                )
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td style="color: red;">{{($cadaConductor == 0) ? '-' : $cadaConductor}}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{
                                                        number_format(
                                                            (
                                                                (
                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][0]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                    (
                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][0]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                            (
                                                                                (sizeof($dias) > 30) ? (
                                                                                    ((sizeof($dias[29]) == 0) ? 0 : $dias[29][0]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[30]) == 0) ? 0 : $dias[30][0]->TRN_AUT_Kilometros_Andados_Turno)
                                                                                ) : 0
                                                                            )
                                                                        ) : 0
                                                                    )
                                                                ) + (($cadaConductor == 0) ? 0 : $cadaConductor)
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        number_format(
                                                            (
                                                                (
                                                                    ((sizeof($dias[15]) == 0) ? 0 : $dias[15][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[16]) == 0) ? 0 : $dias[16][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[17]) == 0) ? 0 : $dias[17][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[18]) == 0) ? 0 : $dias[18][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[19]) == 0) ? 0 : $dias[19][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[20]) == 0) ? 0 : $dias[20][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[21]) == 0) ? 0 : $dias[21][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[22]) == 0) ? 0 : $dias[22][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[23]) == 0) ? 0 : $dias[23][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[24]) == 0) ? 0 : $dias[24][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[25]) == 0) ? 0 : $dias[25][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[26]) == 0) ? 0 : $dias[26][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                    ((sizeof($dias[27]) == 0) ? 0 : $dias[27][1]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                    (
                                                                        (sizeof($dias) > $cantidadFebrero) ? (
                                                                            ((sizeof($dias[28]) == 0) ? 0 : $dias[28][1]->TRN_AUT_Kilometros_Andados_Turno) +
                                                                            (
                                                                                (sizeof($dias) > 30) ? (
                                                                                    ((sizeof($dias[29]) == 0) ? 0 : $dias[29][1]->TRN_AUT_Kilometros_Andados_Turno) + 
                                                                                    ((sizeof($dias[30]) == 0) ? 0 : $dias[30][1]->TRN_AUT_Kilometros_Andados_Turno)
                                                                                ) : 0
                                                                            )
                                                                        ) : 0
                                                                    ) + (($cadaConductor == 0) ? 0 : $cadaConductor)
                                                                )
                                                            ),
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-right: 0px; padding-left: 0px;">
                            <div class="card">
                                <div class="card-body" style="padding: 0;">
                                    <div class="table-responsive m-t-40">
                                        <table border="1" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="display: none;">mes</td>
                                                    <td colspan="2" style="border:1px solid red;">{{Lang::get('messages.Expenses')}}</td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="33" style="display: none;"><p class="verticalText">Diciembre 2020</p></td>
                                                </tr>
                                                <?php $totalGastos = 0 ?>
                                                @foreach ($gastos as $item)
                                                    <tr>
                                                        <td style="width: 75%">
                                                            {{($item->GST_Descripcion_Gasto == null) ? Lang::get('messages.GeneralExpenses') :$item->GST_Descripcion_Gasto}}
                                                        </td>
                                                        <td style="width: 25%">
                                                            {{$item->GST_Costo_Gasto}}
                                                        </td>
                                                    </tr>
                                                    <?php $totalGastos = $totalGastos + $item->GST_Costo_Gasto ?>
                                                @endforeach
                                                <tr>
                                                    <td style="width: 75%">-----</td>
                                                    <td style="width: 25%">-----</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 75%"></td>
                                                    <td style="width: 25%">
                                                        {{$totalGastos}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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

@endsection