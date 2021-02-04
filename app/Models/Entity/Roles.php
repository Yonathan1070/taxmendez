<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = "TBL_Rol";
    protected $fillable = [
        'RL_Nombre_Rol',
        'RL_Slug_Rol',
        'RL_Descripcion_Rol'
    ];
    protected $guarded = ['id'];

}
