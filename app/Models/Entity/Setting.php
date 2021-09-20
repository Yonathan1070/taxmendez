<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = "TBL_Setting";
    protected $fillable = [
        'ST_Empresa_Setting',
        'ST_Nick_Setting',
        'ST_Valor_Setting'
    ];
    protected $guarded = ['id'];

    public static function editar($control, $valor, $empresa){
        $setting = Setting::where('ST_Empresa_Setting', $empresa)->where('ST_Nick_Setting', $control)->first();
        if($setting){
            $setting->update(['ST_Valor_Setting' => $valor]);
        }else{
            $setting = Setting::create([
                'ST_Empresa_Setting' => $empresa,
                'ST_Nick_Setting' => $control,
                'ST_Valor_Setting' => $valor
            ]);
        }
        return true;
    }
}
