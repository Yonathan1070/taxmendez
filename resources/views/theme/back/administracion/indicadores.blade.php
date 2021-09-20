<?php
    $diferencia=0;
    $porcentaje=0;
?>
@if (session()->get('Rol_Nombre') == "Super Administrador")
    <div id="accion-super">
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="social-widget">
                            <div class="soc-header box-facebook">
                                {{Str::upper(Lang::get('messages.Produced'))}}
                            </div>
                            <div class="soc-content">
                                <div class="col-6 b-r">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalDosMeses) ? $generalDosMeses->Producido : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalUnMes) ? $generalUnMes->Producido : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="social-widget">
                            <div class="soc-header box-twitter">
                                {{Str::upper(Lang::get('messages.Expenses'))}}
                            </div>
                            <div class="soc-content">
                                <div class="col-6 b-r">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalDosMeses) ? $generalDosMeses->Gastos : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalUnMes) ? $generalUnMes->Gastos : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="social-widget">
                            <div class="soc-header box-google">
                                {{Str::upper(Lang::get('messages.Gain'))}}
                            </div>
                            <div class="soc-content">
                                <div class="col-6 b-r">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalDosMeses) ? $generalDosMeses->Ganancia : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-medium">
                                        {{'$ '.number_format(($generalUnMes) ? $generalUnMes->Ganancia : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="social-widget">
                            <div class="soc-header box-linkedin">
                                {{Str::upper(Lang::get('messages.Mileage'))}}
                            </div>
                            <div class="soc-content">
                                <div class="col-6 b-r">
                                    <h5 class="font-medium">
                                        {{number_format(($generalDosMeses) ? $generalDosMeses->Kilometraje : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-medium">
                                        {{number_format(($generalUnMes) ? $generalUnMes->Kilometraje : 0, 0, ',', '.')}}
                                    </h5>
                                    <h5 class="text-muted">
                                        {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                    <div class="text-right"> <span class="text-muted">
                            {{Lang::get('messages.Balance')}}
                            {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                        </span>
                        <h3 class="font-light">
                            <sup>
                                @if (((($generalUnMes) ? $generalUnMes->Producido : 0) - (($generalDosMeses) ?
                                $generalDosMeses->Producido : 0)) >= 0)
                                <i class="ti-arrow-up text-success"></i>
                                @else
                                <i class="ti-arrow-down text-danger"></i>
                                @endif
                            </sup>
                            {{'$ '.number_format(((($generalUnMes) ? $generalUnMes->Producido : 0) - (($generalDosMeses) ? $generalDosMeses->Producido : 0)), 0, ',', '.')}}
                        </h3>
                    </div>
                    <?php 
                        $diferencia = (($generalDosMeses) ? $generalDosMeses->Producido : 0) - (($generalUnMes) ? $generalUnMes->Producido : 0);
                        $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                        $porcentaje = round(($diferencia == (($generalUnMes) ? $generalUnMes->Producido : 0)) ? 100 : ($diferencia*100)/(($generalDosMeses) ? $generalDosMeses->Producido : 0));
                    ?>
                    <span class="text-success">{{ $porcentaje .'%'}}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php 
                        $diferencia = 0;
                        $porcentaje = 0;
                    ?>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{Lang::get('messages.Expenses')}}</h4>
                    <div class="text-right"> <span class="text-muted">
                            {{Lang::get('messages.Balance')}}
                            {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                        </span>
                        <h3 class="font-light">
                            <sup>
                                @if (((($generalUnMes) ? $generalUnMes->Gastos : 0) - (($generalDosMeses) ?
                                $generalDosMeses->Gastos : 0)) >= 0)
                                <i class="ti-arrow-up text-danger"></i>
                                @else
                                <i class="ti-arrow-down text-success"></i>
                                @endif
                            </sup>
                            {{'$ '.number_format(((($generalUnMes) ? $generalUnMes->Gastos : 0) - (($generalDosMeses) ? $generalDosMeses->Gastos : 0)), 0, ',', '.')}}
                        </h3>
                    </div>
                    <?php 
                        $diferencia = (($generalDosMeses) ? $generalDosMeses->Gastos : 0) - (($generalUnMes) ? $generalUnMes->Gastos : 0);
                        $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                        $porcentaje = round(($diferencia == (($generalUnMes) ? $generalUnMes->Gastos : 0)) ? 100 : ($diferencia*100)/(($generalDosMeses) ? $generalDosMeses->Gastos : 0));
                    ?>
                    <span class="text-success">{{$porcentaje.'%'}}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php 
                        $diferencia = 0;
                        $porcentaje = 0;
                    ?>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{Lang::get('messages.Gain')}}</h4>
                    <div class="text-right"> <span class="text-muted">
                            {{Lang::get('messages.Balance')}}
                            {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                        </span>
                        <h3 class="font-light">
                            <sup>
                                @if (((($generalUnMes) ? $generalUnMes->Ganancia : 0) - (($generalDosMeses) ?
                                $generalDosMeses->Ganancia : 0)) >= 0)
                                <i class="ti-arrow-up text-success"></i>
                                @else
                                <i class="ti-arrow-down text-danger"></i>
                                @endif
                            </sup>
                            {{'$ '.number_format(((($generalUnMes) ? $generalUnMes->Ganancia : 0) - (($generalDosMeses) ? $generalDosMeses->Ganancia : 0)), 0, ',', '.')}}
                        </h3>
                    </div>
                    <?php 
                        $diferencia = (($generalDosMeses) ? $generalDosMeses->Ganancia : 0) - (($generalUnMes) ? $generalUnMes->Ganancia : 0);
                        $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                        $porcentaje = round(($diferencia == (($generalUnMes) ? $generalUnMes->Ganancia : 0)) ? 100 : ($diferencia*100)/(($generalDosMeses) ? $generalDosMeses->Ganancia : 0));
                    ?>
                    <span class="text-success">{{$porcentaje.'%'}}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php 
                        $diferencia = 0;
                        $porcentaje = 0;
                    ?>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{Lang::get('messages.Mileage')}}</h4>
                    <div class="text-right"> <span class="text-muted">
                            {{Lang::get('messages.Balance')}}
                            {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                        </span>
                        <h3 class="font-light">
                            <sup>
                                @if (((($generalUnMes) ? $generalUnMes->Kilometraje : 0) - (($generalDosMeses) ?
                                $generalDosMeses->Kilometraje : 0)) >= 0)
                                <i class="ti-arrow-up text-danger"></i>
                                @else
                                <i class="ti-arrow-down text-success"></i>
                                @endif
                            </sup>
                            {{number_format(((($generalUnMes) ? $generalUnMes->Kilometraje : 0) - (($generalDosMeses) ? $generalDosMeses->Kilometraje : 0)), 0, ',', '.')}}
                        </h3>
                    </div>
                    <?php 
                        $diferencia = (($generalDosMeses) ? $generalDosMeses->Kilometraje : 0) - (($generalUnMes) ? $generalUnMes->Kilometraje : 0);
                        $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                        $porcentaje = round(($diferencia == (($generalUnMes) ? $generalUnMes->Kilometraje : 0)) ? 100 : ($diferencia*100)/(($generalDosMeses) ? $generalDosMeses->Kilometraje : 0));
                    ?>
                    <span class="text-success">{{$porcentaje.'%'}}</span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php 
                        $diferencia = 0;
                        $porcentaje = 0;
                    ?>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
</div>
@else
    <div id="accion-general">
        <div class="table-responsive m-t-40">
            <div id="accordian-3">
                @foreach ($generalUnMes as $key => $general)
                    <div class="card m-b-0">
                        <a class="card-header text-decoration-none" id="heading{{$key}}" href="javascript:void(0);" >
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse1">
                                <h5 class="m-b-0">{{$general->AUT_Numero_Interno_Automovil}}</h5>
                            </button>
                        </a>
                        <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordian-3">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="social-widget">
                                                        <div class="soc-header box-facebook">
                                                            {{Str::upper(Lang::get('messages.Produced'))}}
                                                        </div>
                                                        <div class="soc-content">
                                                            <div class="col-6 b-r">
                                                                <h5 class="font-medium">{{'$ '.number_format((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Producido : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="font-medium">{{'$ '.number_format(($general) ? $general->Producido : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="social-widget">
                                                        <div class="soc-header box-twitter">
                                                            {{Str::upper(Lang::get('messages.Expenses'))}}
                                                        </div>
                                                        <div class="soc-content">
                                                            <div class="col-6 b-r">
                                                                <h5 class="font-medium">{{'$ '.number_format((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Gastos : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="font-medium">{{'$ '.number_format(($general) ? $general->Gastos : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="social-widget">
                                                        <div class="soc-header box-google">
                                                            {{Str::upper(Lang::get('messages.Gain'))}}
                                                        </div>
                                                        <div class="soc-content">
                                                            <div class="col-6 b-r">
                                                                <h5 class="font-medium">{{'$ '.number_format((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Ganancia : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="font-medium">{{'$ '.number_format(($general) ? $general->Ganancia : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="social-widget">
                                                        <div class="soc-header box-linkedin">
                                                            {{Str::upper(Lang::get('messages.Mileage'))}}
                                                        </div>
                                                        <div class="soc-content">
                                                            <div class="col-6 b-r">
                                                                <h5 class="font-medium">{{number_format((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Kilometraje : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Carbon\Carbon::parse($fechaDosMeses)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="font-medium">{{number_format(($general) ? $general->Kilometraje : 0, 0, ',', '.')}}</h5>
                                                                <h5 class="text-muted">
                                                                    {{Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F')).' '.Carbon\Carbon::parse($fechaUnMes)->format('Y')}}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
                                <!-- Row -->
                                <!-- Row -->
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                                                <div class="text-right"> <span class="text-muted">
                                                    {{Lang::get('messages.Balance')}} {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                                                </span>
                                                    <h3 class="font-light">
                                                        <sup>
                                                            @if (((($general) ? $general->Producido : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Producido : 0)) >= 0)
                                                                <i class="ti-arrow-up text-success"></i>
                                                            @else
                                                                <i class="ti-arrow-down text-danger"></i>
                                                            @endif
                                                        </sup>
                                                        {{'$ '.number_format(((($general) ? $general->Producido : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Producido : 0)), 0, ',', '.')}}
                                                    </h3>
                                                </div>
                                                <?php 
                                                    $diferencia = ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Producido : 0) - (($general) ? $general->Producido : 0);
                                                    $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                                                    $porcentaje = round(($diferencia == (($general) ? $general->Producido : 0)) ? 100 : ($diferencia*100)/((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Producido : 0));
                                                ?>
                                                <span class="text-success">{{$porcentaje.'%'}}</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <?php 
                                                    $diferencia = 0;
                                                    $porcentaje = 0;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">{{Lang::get('messages.Expenses')}}</h4>
                                                <div class="text-right"> <span class="text-muted">
                                                    {{Lang::get('messages.Balance')}} {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                                                </span>
                                                    <h3 class="font-light">
                                                        <sup>
                                                            @if (((($general) ? $general->Gastos : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Gastos : 0)) >= 0)
                                                                <i class="ti-arrow-up text-danger"></i>
                                                            @else
                                                                <i class="ti-arrow-down text-success"></i>
                                                            @endif
                                                        </sup>
                                                        {{'$ '.number_format(((($general) ? $general->Gastos : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Gastos : 0)), 0, ',', '.')}}
                                                    </h3>
                                                </div>
                                                <?php 
                                                    $diferencia = ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Gastos : 0) - (($general) ? $general->Gastos : 0);
                                                    $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                                                    $porcentaje = round(($diferencia == (($general) ? $general->Gastos : 0)) ? 100 : ($diferencia*100)/((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Gastos : 0));
                                                ?>
                                                <span class="text-success">{{$porcentaje.'%'}}</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <?php 
                                                    $diferencia = 0;
                                                    $porcentaje = 0;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">{{Lang::get('messages.Gain')}}</h4>
                                                <div class="text-right"> <span class="text-muted">
                                                    {{Lang::get('messages.Balance')}} {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                                                </span>
                                                <h3 class="font-light">
                                                    <sup>
                                                        @if (((($general) ? $general->Ganancia : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Ganancia : 0)) >= 0)
                                                            <i class="ti-arrow-up text-success"></i>
                                                        @else
                                                            <i class="ti-arrow-down text-danger"></i>
                                                        @endif
                                                    </sup>
                                                    {{'$ '.number_format(((($general) ? $general->Ganancia : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Ganancia : 0)), 0, ',', '.')}}
                                                </h3>
                                                </div>
                                                <?php 
                                                    $diferencia = ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Ganancia : 0) - (($general) ? $general->Ganancia : 0);
                                                    $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                                                    $porcentaje = round(($diferencia == (($general) ? $general->Ganancia : 0)) ? 100 : ($diferencia*100)/((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Ganancia : 0));
                                                ?>
                                                <span class="text-success">{{$porcentaje.'%'}}</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <?php 
                                                    $diferencia = 0;
                                                    
                                                    $porcentaje = 0;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <!-- Column -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">{{Lang::get('messages.Mileage')}}</h4>
                                                <div class="text-right"> <span class="text-muted">
                                                    {{Lang::get('messages.Balance')}} {{Lang::get('messages.'.Carbon\Carbon::parse($fechaDosMeses)->format('F')).' '.Lang::get('messages.'.Carbon\Carbon::parse($fechaUnMes)->format('F'))}}
                                                </span>
                                                <h3 class="font-light">
                                                    <sup>
                                                        @if (((($general) ? $general->Kilometraje : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Kilometraje : 0)) >= 0)
                                                            <i class="ti-arrow-up text-danger"></i>
                                                        @else
                                                            <i class="ti-arrow-down text-success"></i>
                                                        @endif
                                                    </sup>
                                                    {{number_format(((($general) ? $general->Kilometraje : 0) - ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Kilometraje : 0)), 0, ',', '.')}}
                                                </h3>
                                                </div>
                                                <?php 
                                                    $diferencia = ((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Kilometraje : 0) - (($general) ? $general->Kilometraje : 0);
                                                    $diferencia = ($diferencia >= 0) ? $diferencia : $diferencia * -1;
                                                    $porcentaje = round(($diferencia == (($general) ? $general->Kilometraje : 0)) ? 100 : ($diferencia*100)/((!empty($generalDosMeses)) ? $generalDosMeses[$key]->Kilometraje : 0));
                                                ?>
                                                <span class="text-success">{{$porcentaje.'%'}}</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$porcentaje}}%; height: 6px;" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <?php 
                                                    $diferencia = 0;
                                                    
                                                    $porcentaje = 0;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
                                <!-- Row -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif