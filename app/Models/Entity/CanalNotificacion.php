<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalNotificacion extends Model
{
    use HasFactory;

    protected $table = "TBL_Canal_Notificacion";
    protected $fillable = [
        'CNT_Nombre_Canal_Notificacion',
        'CNT_Descripcion_Canal_Notificacion',
        'CNT_Nick_Canal_Notificacion',
        'CNT_Habilitado_Canal_Notificacion'
    ];
    protected $guarded = ['id'];
}
