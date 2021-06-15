@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Automobiles')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
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
                <div class="card-actions">
                    @if (can2('crear_automovil'))
                        <a class="mytooltip" href="{{route('crear_automovil')}}">
                            <i class="ti-plus"></i>
                            <span class="tooltip-content3">
                                {{Lang::get('messages.AddCar')}}
                            </span>
                        </a>
                    @endif
                </div>
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.CarList')}}</h4>
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
                            <th>{{Lang::get('messages.Number')}}</th>
                            <th>{{Lang::get('messages.LicensePlate')}}</th>
                            <th>{{Lang::get('messages.Company')}}</th>
                            @if (can2('propietarios_asignar'))
                                <th>{{Lang::get('messages.Owners')}}</th>
                            @endif
                            @if (can2('balance'))
                                <th>{{Lang::get('messages.Balance')}}</th>
                            @endif
                            @if (can2('editar_automovil'))
                                <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($automoviles as $automovil)
                            <?php $diferenciaDiasSoat = \Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Soat_Automovil)->diffInDays(\Carbon\Carbon::now()->format('Y-m-d')) ?>
                            <?php $diferenciaDiasContractual = \Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil)->diffInDays(\Carbon\Carbon::now()->format('Y-m-d')) ?>
                            <?php $diferenciaDiasExtra = \Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil)->diffInDays(\Carbon\Carbon::now()->format('Y-m-d')) ?>
                            <tr>
                                <td>
                                    {{$automovil->AUT_Numero_Interno_Automovil}}
                                    @if (\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Soat_Automovil)->lt(\Carbon\Carbon::now()->format('Y-m-d')))
                                        <i class="ti-na" style="color: red;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro SOAT vencido" ></i>
                                    @else
                                        @if ((\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Soat_Automovil)->gt(\Carbon\Carbon::now()->format('Y-m-d'))) &&  $diferenciaDiasSoat < 5)
                                            <i class="ti-info-alt" style="color: orange;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro SOAT vence {{($diferenciaDiasSoat == 0) ? 'hoy' : (($diferenciaDiasSoat > 0) ? 'en '.$diferenciaDiasSoat.' días.' : '')}}" ></i>
                                        @else
                                            <i class="ti-check" style="color: green;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro SOAT en regla" ></i>
                                        @endif
                                    @endif
                                    @if (\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil)->lt(\Carbon\Carbon::now()->format('Y-m-d')))
                                        <i class="ti-na" style="color: red;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro Contractual vencido" ></i>
                                    @else
                                        @if ((\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Actual_Automovil)->gt(\Carbon\Carbon::now()->format('Y-m-d'))) &&  $diferenciaDiasContractual < 5)
                                            <i class="ti-info-alt" style="color: orange;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro Contractual vence {{($diferenciaDiasContractual == 0) ? 'hoy' : (($diferenciaDiasContractual > 0) ? 'en '.$diferenciaDiasContractual.' días.' : '')}}" ></i>
                                        @else
                                            <i class="ti-check" style="color: green;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro Contractual en regla" ></i>
                                        @endif
                                    @endif
                                    @if (\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil)->lt(\Carbon\Carbon::now()->format('Y-m-d')))
                                        <i class="ti-na" style="color: red;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro ExtraContractual vencido" ></i>
                                    @else
                                        @if ((\Carbon\Carbon::createFromFormat('Y-m-d', $automovil->AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil)->gt(\Carbon\Carbon::now()->format('Y-m-d'))) &&  $diferenciaDiasExtra < 5)
                                            <i class="ti-info-alt" style="color: orange;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro ExtraContractual vence {{($diferenciaDiasExtra == 0) ? 'hoy' : (($diferenciaDiasExtra > 0) ? 'en '.$diferenciaDiasExtra.' días.' : '')}}" ></i>
                                        @else
                                            <i class="ti-check" style="color: green;" data-toggle="tooltip" data-placement="top" title data-original-title="Seguro ExtraContractual en regla" ></i>
                                        @endif
                                    @endif
                                </td>
                                <td>{{$automovil->AUT_Placa_Automovil}}</td>
                                <td>{{$automovil->EMP_Nombre_Empresa}}</td>
                                @if (can2('propietarios_asignar'))
                                    <td>
                                        <a href="{{route('propietarios_automovil', $automovil->id)}}">
                                            {{Str::of(Lang::get('messages.'.can4('propietarios_asignar')->PRM_Slug_Permiso))->explode(' ')[0]}}
                                        </a>
                                    </td>
                                @endif
                                @if (can2('balance'))
                                    <td>
                                        <a href="{{route(can3('balance')->PRM_Accion_Permiso, $automovil->id)}}">{{Lang::get('messages.'.can3('balance')->PRM_Nombre_Permiso)}}</a>
                                    </td>
                                @endif
                                @if (can2('editar_automovil'))
                                    <td>
                                        <a class="mytooltip" href="{{route('editar_automovil', $automovil->id)}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditCar')}} {{$automovil->AUT_Numero_Interno_Automovil}}
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
    <script src="{{asset("assets/back/plugins/datatables/datatables.min.js")}}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/back/scripts/general.js')}}"></script>
@endsection