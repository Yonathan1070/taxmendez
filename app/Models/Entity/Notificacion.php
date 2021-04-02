<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = "TBL_Notificacion";
    protected $fillable = [
        'NTF_De_Notificacion',
        'NTF_Para_Notificacion',
        'NTF_Icono_Notificacion',
        'NTF_Titulo_Notificacion',
        'NTF_Mensaje_Notificacion',
        'NTF_Tipo_Notificacion',
        'NTF_Ruta_Notificacion',
        'NTF_Nombre_Parametro_Notificacion',
        'NTF_Valor_Parametro_Notificacion',
        'NTF_Atributos_Notificacion',
        'NTF_Visto_Notificacion'
    ];
    protected $guarded = ['id'];

    public static function enviarNotificacion($fromUsuario, $toUsuario, $informacion = []){
        Notificacion::create([
            'NTF_De_Notificacion' => $fromUsuario->id,
            'NTF_Para_Notificacion' => $toUsuario->id,
            'NTF_Icono_Notificacion' => $informacion['icono'],
            'NTF_Titulo_Notificacion' => $informacion['titulo'],
            'NTF_Mensaje_Notificacion' => $informacion['mensaje'],
            'NTF_Tipo_Notificacion' => $informacion['tipo'],
            'NTF_Ruta_Notificacion' => $informacion['ruta'],
            'NTF_Nombre_Parametro_Notificacion' => $informacion['nombreParametro'],
            'NTF_Valor_Parametro_Notificacion' => $informacion['valorParametro'],
            'NTF_Atributos_Notificacion' => $informacion['atributos']
        ]);
    }
}
