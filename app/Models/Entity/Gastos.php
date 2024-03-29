<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;

    protected $table = "TBL_Gastos";
    protected $fillable = [
        'GST_Automovil_Id',
        'GST_Mes_Anio_Gasto',
        'GST_Descripcion_Gasto',
        'GST_Costo_Gasto'
    ];
    protected $guarded = ['id'];

    public function automovil(){
        return $this->hasOne(Automovil::class, 'id', 'GST_Automovil_Id');
    }
}
