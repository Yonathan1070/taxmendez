    <div class="card">
        <div class="card-body">
            <h4 class="card-title m-b-0">{{Lang::get('messages.Monthly')}} {{$automovil->AUT_Numero_Interno_Automovil}}</h4>
            <div class="col-12">
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                                <p class="card-text">{{'$ '.number_format($mensual->Producido, 2, ',', '.')}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Mileage')}}</h4>
                                <p class="card-text">{{$mensual->Kilometraje}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.WorkedDays')}}</h4>
                                <p class="card-text">{{$mensual->DiasTrabajados}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-6 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.AverageDay')}}</h4>
                                <p class="card-text">{{'$ '.number_format($mensual->PromedioDia, 2, ',', '.')}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                    <!-- column -->
                    <div class="col-lg-6 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.AveragePerMileage')}}</h4>
                                <p class="card-text">{{$mensual->PromedioKilometraje}}</p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-12 col-md-12">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{Lang::get('messages.Driver')}}</th>
                                                <th>{{Lang::get('messages.Produced')}}</th>
                                                <th>{{Lang::get('messages.Mileage')}}</th>
                                                <th>{{Lang::get('messages.Turns')}}</th>
                                                <th>{{Lang::get('messages.AverageMileage')}}</th>
                                                <th>{{Lang::get('messages.AverageTurn')}}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($conductores as $conductor)
                                                <tr>
                                                    <td>{{$conductor->USR_Nombres_Usuario}}</td>
                                                    <td>{{'$ '.number_format($conductor->Producido, 0, ',', '.')}}</td>
                                                    <td>{{$conductor->Kilometraje}}</td>
                                                    <td>{{$conductor->Turnos}}</td>
                                                    <td>{{$conductor->PromedioKilometraje}}</td>
                                                    <td>{{'$ '.number_format($conductor->PromedioTurno, 0, ',', '.')}}</td>
                                                    <td style="color: red;">
                                                        @foreach ($conductor->turnosAsignados as $turno)
                                                            {{($loop->last) ? ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)) : ((Lang::get('messages.'.$turno->TRN_Slug_Turno) == 'messages.'.$turno->TRN_Slug_Turno) ? $turno->TRN_Nombre_Turno : Lang::get('messages.'.$turno->TRN_Slug_Turno)).' y '}}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{Lang::get('messages.Produced')}}</h4>
                                <p class="card-text" >{{'$ '.number_format($mensual->Producido, 2, ',', '.')}}</p>
                                <input type="hidden" id="produced" value="{{$mensual->Producido}}">
                                <h4 class="card-title">{{Lang::get('messages.Expenses')}}</h4>
                                <p class="card-text" id="label" style="display: {{($gastos && $gastos->GST_Costo_Gasto >= 0) ? 'block' : 'none'}}">{{'$ '.number_format((!$gastos) ? 0 : $gastos->GST_Costo_Gasto, 2, ',', '.')}}</p>
                                <p class="card-text" id="form" style="display: {{(!$gastos || $gastos->GST_Costo_Gasto == -1) ? 'block' : 'none'}}">
                                    <div id="saveGastos">
                                        <form action="{{route('guardar_gastos', $automovil->id)}}" id="formulario" style="display: {{(!$gastos || $gastos->GST_Costo_Gasto == -1) ? 'block' : 'none'}}" novalidate method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="GST_Costo_Gasto" id="GST_Costo_Gasto" required data-validation-required-message="{{Lang::get('messages.Required')}}" />
                                                    <input type="hidden" name="mesAnioGastosMensualidad" id="mesAnioGastosMensualidad" value="{{$fecha[0].'-'.$fecha[1]}}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info" id="GuardarGastos">{{Lang::get('messages.SaveExpenses')}}</button>
                                        </form>
                                    </div>
                                </p>
                                <h4 class="card-title">{{Lang::get('messages.Gain')}}</h4>
                                <p class="card-text" id="ganancia">
                                    {{'$ '.number_format($ganancia, 2, ',', '.')}}{{($propietarios > 1) ? ' / '.$propietarios.' =  $ '.number_format($ganancia/$propietarios, 2, ',', '.').' C/U' : ''}}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
            </div>
            <div class="row button-group">
                <div class="col-lg-3 col-md-4">
                    <form action="{{route('balance_mensual_pdf', ['id'=>Crypt::encrypt($automovil->id)])}}" method="POST">
                        @csrf
                        <input name="mesAnio" id="mesAnio" type="hidden" value="{{$fecha[0].'-'.$fecha[1]}}">
                        <button type="submit" id="turnos" class="btn btn-block btn-success">{{Lang::get('messages.PdfGenerate')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>