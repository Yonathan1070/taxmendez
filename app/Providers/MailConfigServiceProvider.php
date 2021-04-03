<?php

namespace App\Providers;

use App\Models\Entity\ServidorCorreo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $emailServices = ServidorCorreo::where('SRC_Empresa_Servidor', session()->get('Empresa_Id'))->latest()->first();

        if ($emailServices) {
            $config = array(
                'driver'     => $emailServices->SRC_Driver_Servidor,
                'host'       => $emailServices->SRC_Host_Servidor,
                'port'       => $emailServices->SRC_Puerto_Servidor,
                'username'   => $emailServices->SRC_Nombre_Usuario_Servidor,
                'password'   => $emailServices->SRC_Password_Servidor,
                'encryption' => null,
                'from'       => array('address' => $emailServices->SRC_Direccion_De_Servidor, 'name' => $emailServices->SRC_Nombre_De_Servidor),
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
            );

            Config::set('mail', $config);
        }
    }
}
