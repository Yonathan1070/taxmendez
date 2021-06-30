<?php

namespace App\Http\Controllers;

use App\Models\Entity\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class RolesController extends Controller
{
    public function index()
    {
        can('roles');

        $roles = Roles::orderBy('id')->paginate(10);

        return view(
            'theme.back.roles.listar',
            compact(
                'roles'
            )
        );
    }

    public function crear(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_rol')){
                return view('theme.back.roles.crear');
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function guardar(Request $request)
    {
        if($request->ajax()){
            if(can2('crear_rol')){
                DB::beginTransaction();
                if(!Roles::where('RL_Nombre_Rol', $request->RL_Nombre_Rol)->first()){
                    $rol = Roles::crearRol($request);

                    if($rol){
                        DB::commit();
                        return $this->vista(Lang::get('messages.CreatedRol'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.ExistingRol'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function editar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('editar_rol')){
                $rol = Roles::findOrFail($id);
        
                return view('theme.back.roles.editar', compact('rol'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function actualizar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('editar_rol')){
                DB::beginTransaction();
                if(!Roles::where('id', '<>', $id)->where('RL_Nombre_Rol', $request->RL_Nombre_Rol)->first()){
                    $rol = Roles::editarRol($request, $id);
            
                    if($rol){
                        DB::commit();
                        return $this->vista(Lang::get('messages.UpdatedRol'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    DB::rollBack();
                }
                DB::rollBack();
                return response()->json(['mensaje'=>Lang::get('messages.ExistingRol'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            if(can2('eliminar_rol')){
                if(Roles::eliminarRol($id)){
                    DB::commit();
                    return response()->json(['mensaje'=>Lang::get('messages.DeletedRol'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
                }
                DB::rollBack();
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        $roles = Roles::orderBy('id')->paginate(10);
        return response()->json(['view'=>view('theme.back.roles.table-data')->with('roles', $roles)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $roles = Roles::orderBy('id')->paginate(10);
            return view('theme.back.roles.table-data', compact('roles'))->render();
        }
    }
}
