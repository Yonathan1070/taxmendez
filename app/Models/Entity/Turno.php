<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class Turno extends Model
{
    use HasFactory;

    protected $table = "TBL_Turno";
    protected $fillable = [
        'TRN_Nombre_Turno',
        'TRN_Slug_Turno',
        'TRN_Descripcion_Turno',
        'TRN_Color_Turno',
        'TRN_Valor_Turno'
    ];
    protected $guarded = ['id'];

    public static function crear($request){
        $turno = Turno::create([
            'TRN_Nombre_Turno' => $request->TRN_Nombre_Turno,
            'TRN_Slug_Turno' => Str::slug($request->TRN_Nombre_Turno, '_'),
            'TRN_Descripcion_Turno' => $request->TRN_Descripcion_Turno,
            'TRN_Color_Turno' => $request->TRN_Color_Turno,
            'TRN_Valor_Turno' => $request->TRN_Valor_Turno
        ]);

        return $turno;
    }

    public static function editar($turno, $request){
        $turnoEditado = $turno->update([
            'TRN_Nombre_Turno' => $request->TRN_Nombre_Turno,
            'TRN_Slug_Turno' => Str::slug($request->TRN_Nombre_Turno, '_'),
            'TRN_Descripcion_Turno' => $request->TRN_Descripcion_Turno,
            'TRN_Color_Turno' => $request->TRN_Color_Turno,
            'TRN_Valor_Turno' => $request->TRN_Valor_Turno
        ]);

        return $turnoEditado;
    }

    public static function eliminar($id){
        try {
            Turno::destroy($id);
            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }
}
