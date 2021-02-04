<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "TBL_Categoria";
    protected $fillable = [
        'CAT_Nombre_Categoria',
        'CAT_Nick_Categoria'
    ];
    protected $guarded = ['id'];
}
