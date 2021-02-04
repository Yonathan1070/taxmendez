<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = "TBL_Setting";
    protected $fillable = [
        'ST_Nick_Setting',
        'ST_Valor_Setting'
    ];
    protected $guarded = ['id'];
}
