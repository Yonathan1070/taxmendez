<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Permiso extends Model
{
    use HasFactory;

    protected $table = "TBL_Permiso";
    protected $fillable = [
        'PRM_Nombre_Permiso',
        'PRM_Slug_Permiso',
        'PRM_Menu_Permiso',
        'PRM_Orden_Menu_Permiso',
        'PRM_Icono_Permiso',
        'PRM_Accion_Permiso',
        'PRM_Categoria_Permiso'
    ];
    protected $guarded = ['id'];

    public static function crearPermiso($request, $slugPermiso){
        $permiso = Permiso::create([
            'PRM_Nombre_Permiso' => $request->PRM_Nombre_Permiso,
            'PRM_Slug_Permiso' => $slugPermiso,
            'PRM_Menu_Permiso' => $request->has('PRM_Menu_Permiso'),
            'PRM_Icono_Permiso' => $request->PRM_Icono_Permiso,
            'PRM_Accion_Permiso' => $request->PRM_Accion_Permiso,
            'PRM_Categoria_Permiso' => $request->PRM_Categoria_Permiso
        ]);

        return $permiso;
    }

    public static function editarPermiso($request, $slugPermiso, $id){
        $permiso = Permiso::find($id)->update([
            'PRM_Nombre_Permiso' => $request->PRM_Nombre_Permiso,
            'PRM_Slug_Permiso' => $slugPermiso,
            'PRM_Menu_Permiso' => $request->has('PRM_Menu_Permiso'),
            'PRM_Icono_Permiso' => $request->PRM_Icono_Permiso,
            'PRM_Accion_Permiso' => $request->PRM_Accion_Permiso,
            'PRM_Categoria_Permiso' => $request->PRM_Categoria_Permiso
        ]);

        return $permiso;
    }

    public static function eliminarPermiso($id){
        try {
            Permiso::destroy($id);
            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }
}
