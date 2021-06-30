<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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

    public static function crearRol($request){
        $rol = Roles::create([
            'RL_Nombre_Rol' => $request->RL_Nombre_Rol,
            'RL_Descripcion_Rol' => $request->RL_Descripcion_Rol
        ]);

        return $rol;
    }

    public static function editarRol($request, $id){
        $rol = Roles::find($id)
            ->update([
                'RL_Nombre_Rol' => $request->RL_Nombre_Rol,
                'RL_Descripcion_Rol' => $request->RL_Descripcion_Rol
            ]);

        return $rol;
    }

    public static function eliminarRol($id){
        try {
            Roles::destroy($id);
            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }

}
