<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = "TBL_Turno";
    protected $fillable = [
        'TRN_Nombre_Turno',
        'TRN_Slug_Turno',
        'TRN_Descripcion_Turno',
        'TRN_Color_Turno',
        'TRN_Valor_Turno'
    ];
    protected $guarded = ['id'];
}
