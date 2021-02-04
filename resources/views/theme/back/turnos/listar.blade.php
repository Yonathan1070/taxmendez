@extends('theme.back.layout')
@section('title')
    {{Lang::get('messages.Turns')}}
@endsection
@section('styles')
    <link href="{{asset("assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{Lang::get('messages.Turns')}}</h3>
    </div>
</div>
@endsection
@section('contenido')
<div class="col-md-12 col-xlg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-actions">
                @if (can2('crear_turno'))
                    <a class="mytooltip" href="{{route('crear_turno')}}">
                        <i class="ti-plus"></i>
                        <span class="tooltip-content3">
                            {{Lang::get('messages.AddTurn')}}
                        </span>
                    </a>
                @endif
            </div>
            <h4 class="card-title m-b-0">{{Lang::get('messages.TurnsList')}}</h4>
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
                            <th>{{Lang::get('messages.Turn')}}</th>
                            <th>{{Lang::get('messages.Value')}}</th>
                            <th>{{Lang::get('messages.Description')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)
                            <tr>
                                <td>{{$turno->TRN_Nombre_Turno}}</td>
                                <td>{{$turno->TRN_Valor_Turno}}</td>
                                <td>{{$turno->TRN_Descripcion_Turno}}</td>
                                <td>
                                    @if (can2('editar_turno'))
                                        <a class="mytooltip" href="{{route('editar_turno', ['id'=>Crypt::encrypt($turno->id)])}}">
                                            <i class="ti-pencil"></i>
                                            <span class="tooltip-content3">
                                                {{Lang::get('messages.EditTurn')}} {{$turno->TRN_Nombre_Turno}}
                                            </span>
                                        </a>
                                    @endif
                                </td>
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