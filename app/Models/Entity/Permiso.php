<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = "TBL_Permiso";
    protected $fillable = [
        'PRM_Nombre_Permiso',
        'PRM_Slug_Permiso',
        'PRM_Menu_Permiso',
        'PRM_Orden_Menu_Permiso',
        'PRM_Icono_Permiso',
        'PRM_Accion_Permiso',
        'PRM_Categoria_Permiso'
    ];
    protected $guarded = ['id'];
}
