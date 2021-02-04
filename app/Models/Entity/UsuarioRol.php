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
}
