<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomovilPropietario extends Model
{
    use HasFactory;

    protected $table = "TBL_Automovil_Propietario";
    protected $fillable = [
        'AUT_PRP_Automovil_Id',
        'AUT_PRP_Propietario_Id',
        'AUT_PRO_Tarjeta_Propiedad_Automovil'
    ];
    protected $guarded = ['id'];
}
