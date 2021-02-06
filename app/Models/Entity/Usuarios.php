<?php

namespace App\Models\Entity;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'TBL_Usuario';
    protected $fillable = ['USR_Tipo_Documento_Usuario',
        'USR_Documento_Usuario',
        'USR_Fecha_Vencimiento_Licencia_Usuario',
        'USR_Nombres_Usuario',
        'USR_Apellidos_Usuario',
        'USR_Fecha_Nacimiento_Usuario',
        'USR_Direccion_Residencia_Usuario',
        'USR_Telefono_Usuario',
        'USR_Correo_Usuario',
        'USR_Nombre_Usuario',
        'password',
        'USR_Foto_Perfil_Usuario',
        'USR_Empresa_Id',
        'USR_Conductor_Fijo_Usuario'
    ];
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function roles()
    {
        return $this->belongsToMany(
            Roles::class,
            'TBL_Rol_Usuario',
            'USR_RL_Usuario_Id',
            'USR_RL_Rol_Id'
        )->withPivot('USR_RL_Usuario_Id', 'USR_RL_Rol_Id');
    }

    public function setSession($roles)
    {
        Session::put([
            'Usuario_Id' => $this->id,
            'Empresa_Id' => $this->USR_Empresa_Id
        ]);
        if (count($roles) == 1) {
            Session::put([
                'Rol_Id' => $roles[0]['id'],
                'Rol_Nombre' => $roles[0]['RL_Nombre_Rol'],
            ]);
        } else {
            Session::put([
                'roles' => $roles
            ]);
        }
        /*$sesion = SesionUsuario::where('SES_USR_Usuario_Id', $this->id)->first();
        if ($sesion != null){
            $sesion->update([
                'SES_USR_Fecha_Sesion' => Carbon::now(),
                'SES_USR_Estado_Sesion' => 1
            ]);
        } else {
            SesionUsuario::create([
                'SES_USR_Fecha_Sesion' => Carbon::now(),
                'SES_USR_Estado_Sesion' => 1,
                'SES_USR_Usuario_Id' => $this->id
            ]);
        }*/
    }
}
