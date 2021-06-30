<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class CanalNotificacion extends Model
{
    use HasFactory;

    protected $table = "TBL_Canal_Notificacion";
    protected $fillable = [
        'CNT_Nombre_Canal_Notificacion',
        'CNT_Descripcion_Canal_Notificacion',
        'CNT_Nick_Canal_Notificacion',
        'CNT_Habilitado_Canal_Notificacion'
    ];
    protected $guarded = ['id'];

    public static function crear($request, $nick){
        $canal = CanalNotificacion::create([
            'CNT_Nombre_Canal_Notificacion' => $request->CNT_Nombre_Canal_Notificacion,
            'CNT_Descripcion_Canal_Notificacion' => $request->CNT_Descripcion_Canal_Notificacion,
            'CNT_Nick_Canal_Notificacion' => $nick,
            'CNT_Habilitado_Canal_Notificacion' => $request->has('CNT_Habilitado_Canal_Notificacion')
        ]);

        return $canal;
    }

    public static function editar($canal, $request, $nick){
        $canalEditado = $canal->update([
            'CNT_Nombre_Canal_Notificacion' => $request->CNT_Nombre_Canal_Notificacion,
            'CNT_Descripcion_Canal_Notificacion' => $request->CNT_Descripcion_Canal_Notificacion,
            'CNT_Nick_Canal_Notificacion' => $nick,
            'CNT_Habilitado_Canal_Notificacion' => $request->has('CNT_Habilitado_Canal_Notificacion')
        ]);

        return $canalEditado;
    }

    public static function eliminar($id){
        try {
            CanalNotificacion::destroy($id);
            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }
}
