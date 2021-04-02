<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioCanalNotificacion extends Model
{
    use HasFactory;

    protected $table = "TBL_Usuario_Canal_Notificacion";
    protected $fillable = [
        'USR_CNT_Usuario_Id',
        'USR_CNT_Canal_Id'
    ];
    public $timestamps = false;
}
