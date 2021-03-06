<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlDesinfeccion extends Model
{
    use HasFactory;

    protected $table = "TBL_Control_Desinfeccion";
    protected $fillable = [
        'CTD_Fecha_Hora_Desinfeccion',
        'CTD_Automovil_Id',
        'CTD_Usuario_Id',
        'CTD_Temperatura_Control_Desinfeccion',
        'CTD_Firma_Control_Desinfeccion'
    ];
    protected $guarded = ['id'];

    public function automovil(){
        return $this->hasOne(Automovil::class, 'id', 'CTD_Automovil_Id');
    }

    public function conductor(){
        return $this->hasOne(Usuarios::class, 'id', 'CTD_Usuario_Id');
    }
}
