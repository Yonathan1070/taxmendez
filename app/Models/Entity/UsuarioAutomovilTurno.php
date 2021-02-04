<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioAutomovilTurno extends Model
{
    use HasFactory;

    protected $table = "TBL_Usuario_Automovil_Turno";
    protected $fillable = [
        'TRN_AUT_Automovil_Id',
        'TRN_AUT_Kilometraje_Turno',
        'TRN_AUT_Kilometros_Andados_Turno',
        'TRN_AUT_Producido_Turno',
        'TRN_AUT_Usuario_Turno_Id',
        'TRN_AUT_Fecha_Turno',
        'TRN_AUT_Turno_Id',
        'TRN_AUT_Observacion_Turno_Seleccionado'
    ];
    protected $guarded = ['id'];
}
