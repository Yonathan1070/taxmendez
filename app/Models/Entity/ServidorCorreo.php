<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorCorreo extends Model
{
    use HasFactory;

    protected $table = "TBL_Servidor_Correo";
    protected $fillable = [
        'SRC_Driver_Servidor',
        'SRC_Host_Servidor',
        'SRC_Puerto_Servidor',
        'SRC_Nombre_Usuario_Servidor',
        'SRC_Password_Servidor',
        'SRC_Encriptacion_Servidor',
        'SRC_Direccion_De_Servidor',
        'SRC_Nombre_De_Servidor',
        'SRC_Empresa_Servidor'
    ];
    protected $guarded = ['id'];

    public function empresa(){
        return $this->hasOne(Empresa::class, 'id', 'SRC_Empresa_Servidor');
    }
}
