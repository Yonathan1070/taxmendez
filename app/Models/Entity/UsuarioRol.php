<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    use HasFactory;

    protected $table = "TBL_Rol_Usuario";
    protected $fillable = [
        'USR_RL_Usuario_Id',
        'USR_RL_Rol_Id',
        'USR_RL_Estado'
    ];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function crear($usuario, $request){
        $usuario_rol = UsuarioRol::create([
            'USR_RL_Usuario_Id' => $usuario->id,
            'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
            'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
        ]);

        return $usuario_rol;
    }

    public static function editar($usuario, $request){
        $usuario_rol = UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)->first()
            ->update([
                'USR_RL_Rol_Id' => $request->USR_Tipo_Usuario_Usuario,
                'USR_RL_Estado' => ($request->has('USR_Activo_Usuario'))? 1 : 0
            ]);
        
        return $usuario_rol;
    }
}
