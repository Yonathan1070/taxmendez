<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Empresa extends Model
{
    use HasFactory;

    protected $table = "TBL_Empresa";
    protected $fillable = [
        'EMP_Nombre_Empresa',
        'EMP_NIT_Empresa',
        'EMP_Telefono_Empresa',
        'EMP_Direccion_Empresa',
        'EMP_Correo_Empresa',
        'EMP_Logo_Empresa',
        'EMP_Logo_Texto_Empresa'
    ];
    protected $guarded = ['id'];

    public function usuarios()
    {
        return $this->hasMany(Usuarios::class);
    }

    public static function crear($request, $imagenComoBase64, $textoLogoComoBase64){
        $empresa = Empresa::create([
            'EMP_Nombre_Empresa' => $request->EMP_Nombre_Empresa,
            'EMP_NIT_Empresa' => $request->EMP_NIT_Empresa,
            'EMP_Telefono_Empresa' => $request->EMP_Telefono_Empresa,
            'EMP_Direccion_Empresa' => $request->EMP_Direccion_Empresa,
            'EMP_Correo_Empresa' => $request->EMP_Correo_Empresa,
            'EMP_Logo_Empresa' => $imagenComoBase64,
            'EMP_Logo_Texto_Empresa' => $textoLogoComoBase64
        ]);

        return $empresa;
    }

    public static function editar($empresa, $request, $imagenComoBase64, $textoLogoComoBase64){
        $empresa = $empresa->update([
            'EMP_Nombre_Empresa' => $request->EMP_Nombre_Empresa,
            'EMP_NIT_Empresa' => $request->EMP_NIT_Empresa,
            'EMP_Telefono_Empresa' => $request->EMP_Telefono_Empresa,
            'EMP_Direccion_Empresa' => $request->EMP_Direccion_Empresa,
            'EMP_Correo_Empresa' => $request->EMP_Correo_Empresa,
            'EMP_Logo_Empresa' => $imagenComoBase64,
            'EMP_Logo_Texto_Empresa' => $textoLogoComoBase64
        ]);

        return $empresa;
    }

    public static function eliminar($id){
        try {
            Empresa::destroy($id);

            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }

}
