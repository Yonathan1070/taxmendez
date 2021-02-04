<div class="col-md-7 col-4 align-self-center">
    <div class="d-flex m-t-10 justify-content-end">
        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
            <div class="chart-text m-r-10">
                <h6 class="m-b-0"><small>{{Str::upper(Lang::get('messages.'.\Carbon\Carbon::now()->addMonths(-2)->format('F')))}}</small></h6>
                <h4 class="m-t-0 text-info">{{'$ '.number_format(($dosMesesAntes) ? $dosMesesAntes->Producido : 0, 2, ',', '.')}}</h4>
            </div>
        </div>
        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
            <div class="chart-text m-r-10">
                <h6 class="m-b-0"><small>{{Str::upper(Lang::get('messages.'.\Carbon\Carbon::now()->addMonths(-1)->format('F')))}}</small></h6>
                <h4 class="m-t-0 text-info">{{'$ '.number_format(($unMesAntes) ? $unMesAntes->Producido : 0, 2, ',', '.')}}</h4>
            </div>
        </div>
        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
            <div class="chart-text m-r-10">
                <h6 class="m-b-0"><small>{{Str::upper(Lang::get('messages.'.\Carbon\Carbon::now()->format('F')))}}</small></h6>
                <h4 class="m-t-0 text-info">{{'$ '.number_format(($mesActual) ? $mesActual->Producido : 0, 2, ',', '.')}}</h4>
            </div>
        </div>
    </div>
</div>