<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

/**
 * Helper permisos, encargado de validar si tiene acceso al permiso por medio del
 * slug del permiso.
 * 
 * @author: Yonathan Bohorquez
 * @email: 
 * 
 * @version: dd/MM/yyyy 1.0
 */
if (!function_exists('can') && !function_exists('can2') && !function_exists('can3') && !function_exists('can4')) {
    function can($permiso, $redirect = true)
    {
        if (session()->get('Rol_Nombre') == 'Super Administrador') {
            return true;
        } else {
            $usuariosId = session()->get('Usuario_Id');
            $permisos = DB::table('TBL_Permiso as p')
                ->join('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', '=', 'p.id')
                ->join('TBL_Usuario as u', 'u.id', '=', 'pu.PRM_USR_Usuario_Id')
                ->where('PRM_USR_Usuario_Id', $usuariosId)
                ->where('PRM_Slug_Permiso', $permiso)
                ->first();
            if (!$permisos) {
                if ($redirect) {
                    if (!request()->ajax())
                        return redirect()
                            ->route('administracion')
                            ->with('mensaje', Lang::get('messages.AccessDenied'))
                            ->send();
                    return false;
                } else {
                    return false;
                }
            }
            return true;
        }
    }

    function can2($permiso, $redirect = true)
    {
        if (session()->get('Rol_Nombre') == 'Super Administrador') {
            return true;
        } else {
            $usuariosId = session()->get('Usuario_Id');
            $permisos = DB::table('TBL_Permiso as p')
                ->join('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', '=', 'p.id')
                ->join('TBL_Usuario as u', 'u.id', '=', 'pu.PRM_USR_Usuario_Id')
                ->where('PRM_USR_Usuario_Id', $usuariosId)
                ->where('PRM_Slug_Permiso', $permiso)
                ->first();
            if (!$permisos) {
                if ($redirect) {
                    if (!request()->ajax())
                        return false;
                    return false;
                } else {
                    return false;
                }
            }
            return true;
        }
    }

    function can3($permiso)
    {
        $usuariosId = session()->get('Usuario_Id');
        $permisos = DB::table('TBL_Permiso as p')
            ->join('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', '=', 'p.id')
            ->join('TBL_Usuario as u', 'u.id', '=', 'pu.PRM_USR_Usuario_Id')
            ->where('PRM_USR_Usuario_Id', $usuariosId)
            ->where('PRM_Slug_Permiso', $permiso)
            ->select('p.*')
            ->first();
        
        if (!$permisos) {
            return null;
        }
        return $permisos;
    }

    function can4($permiso)
    {
        $permisos = DB::table('TBL_Permiso as p')
            ->where('PRM_Slug_Permiso', $permiso)
            ->select('p.*')
            ->first();
        
        if (!$permisos) {
            return null;
        }
        return $permisos;
    }
}