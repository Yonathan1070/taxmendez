<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="mdi mdi-message"></i>
        @if ($notificaciones_no_vistas->count() > 0)
            <div class="notify">
                <span class="heartbit"></span>
                <span class="point"></span>
            </div>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
        <ul>
            <li>
                <div class="drop-title">{{Lang::get('messages.Notifications')}}</div>
            </li>
            <li>
                <div class="message-center">
                    <!-- Notification -->
                    @foreach ($notificaciones as $notificacion)
                        @if ($notificacion->NTF_Tipo_Notificacion == 'get')
                            <a href="(($notificacion->NTF_Nombre_Parametro_Notificacion != null && $notificacion->NTF_Valor_Parametro_Notificacion != null) ? route($notificacion->NTF_Ruta_Notificacion, [$notificacion->NTF_Nombre_Parametro_Notificacion => $notificacion->NTF_Valor_Parametro_Notificacion]) : route($notificacion->NTF_Ruta_Notificacion))">
                                <div class="btn btn-primary btn-circle">
                                    <i class="{{$notificacion->NTF_Icono_Notificacion}}"></i>
                                </div>
                                <div class="mail-contnet">
                                    <h5>{{$notificacion->NTF_Titulo_Notificacion}}</h5>
                                    <span class="mail-desc">
                                        {{$notificacion->NTF_Mensaje_Notificacion}}
                                    </span>
                                    <span class="time">{{\Carbon\Carbon::create_from_format('Y-m-d', $notificacion->created_at)->format('Y-m-d')}}</span>
                                </div>
                            </a>
                        @else
                            <a onclick="formHref('{{(($notificacion->NTF_Nombre_Parametro_Notificacion != null && $notificacion->NTF_Valor_Parametro_Notificacion != null) ? route($notificacion->NTF_Ruta_Notificacion, [$notificacion->NTF_Nombre_Parametro_Notificacion => Crypt::encrypt($notificacion->NTF_Valor_Parametro_Notificacion)]) : route($notificacion->NTF_Ruta_Notificacion))}}', '{{$notificacion->NTF_Atributos_Notificacion}}', '{{csrf_token()}}', '{{$notificacion->id}}')">
                                <div class="btn btn-primary btn-circle">
                                    <i class="{{$notificacion->NTF_Icono_Notificacion}}"></i>
                                </div>
                                <div class="mail-contnet">
                                    <h5>{{Lang::get('messages.'.$notificacion->NTF_Titulo_Notificacion)}}</h5>
                                    <span class="mail-desc">
                                        {{Lang::get('messages.'.$notificacion->NTF_Mensaje_Notificacion)}}
                                    </span>
                                    <span class="time">
                                        @if (\Carbon\Carbon::now()->diffInSeconds($notificacion->created_at) < 60)
                                            {{\Carbon\Carbon::now()->diffInSeconds($notificacion->created_at).' '.Lang::get('messages.Seconds')}}
                                        @elseif(\Carbon\Carbon::now()->diffInMinutes($notificacion->created_at) < 60)
                                            {{\Carbon\Carbon::now()->diffInMinutes($notificacion->created_at).' '.Lang::get('messages.Minuts')}}
                                        @elseif(\Carbon\Carbon::now()->diffInHours($notificacion->created_at) < 24)
                                            {{\Carbon\Carbon::now()->diffInHours($notificacion->created_at).' '.Lang::get('messages.Hours')}}
                                        @else
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $notificacion->created_at)->format('d-m-Y')}}
                                        @endif
                                    </span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    <!-- Notification -->
                </div>
            </li>
            <li>
                <a class="nav-link text-center" href="javascript:void(0);">
                    <strong>
                        {{Lang::get('messages.AllNotifications')}}
                    </strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</li>