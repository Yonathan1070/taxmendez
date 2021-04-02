<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automovil extends Model
{
    use HasFactory;

    protected $table = "TBL_Automovil";
    protected $fillable = [
        'AUT_Placa_Automovil',
        'AUT_Numero_Interno_Automovil',
        'AUT_Fecha_Vencimiento_Soat_Automovil',
        'AUT_Fecha_Vencimiento_Seguro_Actual_Automovil',
        'AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil',
        'AUT_Empresa_Id',
        'AUT_Foto_Automovil'
    ];
    protected $guarded = ['id'];

    public function empresa(){
        return $this->hasOne(Empresa::class, 'id', 'AUT_Empresa_Id');
    }

    public function propietarios()
    {
        return $this->belongsToMany(
            Usuarios::class,
            'TBL_Automovil_Propietario',
            'AUT_PRP_Automovil_Id',
            'AUT_PRP_Propietario_Id'
        )->withPivot('AUT_PRP_Automovil_Id', 'AUT_PRP_Propietario_Id');
    }
}
