<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    use HasFactory;

    protected $table = "TBL_Mensualidad";
    protected $fillable = [
        'MNS_Automovil_Id',
        'MNS_Producido_Mensualidad',
        'MNS_Gastos_Mensualidad',
        'MNS_Kilometraje_Mensualidad',
        'MNS_Dias_Trabajados_Mensualidad',
        'MNS_Mes_Anio_Mensualidad'
    ];
    protected $guarded = ['id'];
}
