<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    protected $table = "TBL_Idioma";
    protected $fillable = [
        'IDM_Nombre_Idioma',
        'IDM_Short_Alias_Idioma',
        'IDM_Long_Alias_Idioma',
        'IDM_Nick_Idioma'
    ];
    protected $guarded = ['id'];
}
