<?php

namespace App\Http\Controllers;

use App\Models\Entity\Categoria;
use App\Models\Entity\Permiso;
use App\Models\Entity\PermisoUsuario;
use App\Models\Entity\Roles;
use App\Models\Entity\Usuarios;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        can('permisos_asignar');

        try {
            $usuarioId = Crypt::decrypt($id);
            $usuario = Usuarios::findOrFail($usuarioId);

            if($usuario){
                $categorias = Categoria::get();
                $permisosAsignados = DB::table('TBL_Permiso as p')
                    ->leftJoin('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', 'p.id')
                    ->leftJoin('TBL_Usuario as u', 'u.id', 'pu.PRM_USR_Usuario_Id')
                    ->where('pu.PRM_USR_Usuario_Id', $usuario->id)
                    ->select('pu.*', 'p.*')
                    ->orderBy('p.created_at')
                    ->get();

                $permisosGeneral = Permiso::get();
                $permisosNoAsignados = [];
                foreach ($permisosGeneral as $prm) {
                    if(!$permisosAsignados->contains('id', $prm->id)) {
                        array_push($permisosNoAsignados, $prm);
                    }
                }
                
                return view('theme.back.permisos.listar', compact('usuario', 'categorias', 'permisosAsignados', 'permisosNoAsignados'));
            }

        } catch (DecryptException $e) {
            dd('error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar()
    {
        $rol = Roles::findOrFail(session()->get('Usuario_Id'));
        if($rol && $rol->id == 1){
            $permisos = DB::table('TBL_Permiso as p')
                ->join('TBL_Categoria as c', 'c.id', 'p.PRM_Categoria_Permiso')
                ->select('c.*', 'p.*')
                ->orderBy('p.PRM_Nombre_Permiso')
                ->paginate(10);

            return view('theme.back.permisos.listado', compact('permisos'));
        } else{
            return redirect()->route('administracion')->withErrors(Lang::get('messages.AccesDenied'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                $categorias = Categoria::get();
                return view('theme.back.permisos.crear', compact('categorias'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                if(!($request->has('PRM_Menu_Permiso') && $request->PRM_Icono_Permiso)){
                    $slugPermiso = Str::slug($request->PRM_Nombre_Permiso, '_');
                    $permiso = Permiso::where('PRM_Slug_Permiso',  $slugPermiso)
                        ->where('PRM_Menu_Permiso', $request->has('PRM_Menu_Permiso'))
                        ->first();
                    if(!$permiso){
                        Permiso::create([
                            'PRM_Nombre_Permiso' => $request->PRM_Nombre_Permiso,
                            'PRM_Slug_Permiso' => $slugPermiso,
                            'PRM_Menu_Permiso' => $request->has('PRM_Menu_Permiso'),
                            'PRM_Icono_Permiso' => $request->PRM_Icono_Permiso,
                            'PRM_Accion_Permiso' => $request->PRM_Accion_Permiso,
                            'PRM_Categoria_Permiso' => $request->PRM_Categoria_Permiso
                        ]);

                        return $this->vista(Lang::get('messages.PermissionCreated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                    }
                    return response()->json(['mensaje'=>Lang::get('messages.ExistingPermission'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                }
                return response()->json(['mensaje'=>Lang::get('messages.IconRequired'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardarPermiso(Request $request, $id)
    {
        try {
            $usuarioId = Crypt::decrypt($id);
            $usuario = Usuarios::findOrFail($usuarioId);

            if($usuario){
                $permisos = Permiso::get();
                foreach ($permisos as $permiso) {
                    if($request->has('cbx_'.$permiso->id)) {
                        if(!$this->verificarPermiso($usuarioId, $permiso->id)){
                            PermisoUsuario::create([
                                'PRM_USR_Usuario_Id' => $usuarioId,
                                'PRM_USR_Permiso_Id' => $permiso->id
                            ]);
                        }
                    } else {
                        if($this->verificarPermiso($usuarioId, $permiso->id)){
                            PermisoUsuario::where('PRM_USR_Usuario_Id', $usuarioId)
                                ->where('PRM_USR_Permiso_Id', $permiso->id)
                                ->first()->delete();
                        }
                    }
                }
                
                return redirect()
                    ->route('usuarios')
                    ->with('mensaje', Lang::get('messages.AssignedPermissions'));
            }
            return redirect()->route('usuarios')->with('mensaje', Lang::get('messages.UserNotExists'));
        } catch (DecryptException $e) {
            return redirect()->route('turnos')->withErrors(Lang::get('messages.IdNotValid'));
        }
    }

    private function verificarPermiso($usuarioId, $permisoId){
        $permiso = PermisoUsuario::where('PRM_USR_Usuario_Id', $usuarioId)
            ->where('PRM_USR_Permiso_Id', $permisoId)
            ->first();
        
        if($permiso){
            return true;
        }
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                $permiso = Permiso::findOrFail($id);

                if($permiso){
                    $categorias = Categoria::get();

                    return view('theme.back.permisos.editar', compact('permiso', 'categorias'));
                }
                return response()->json(['mensaje'=>Lang::get('messages.PermissionNotExists'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                $permiso = Permiso::findOrFail($id);
                if($permiso){
                    if(!($request->has('PRM_Menu_Permiso') && !$request->PRM_Icono_Permiso)){
                        $slugPermiso = Str::slug($request->PRM_Nombre_Permiso, '_');
                        $permiso = Permiso::where('PRM_Slug_Permiso',  $slugPermiso)
                            ->where('PRM_Menu_Permiso', $request->has('PRM_Menu_Permiso'))
                            ->where('id', '!=', $id)
                            ->first();
                        if(!$permiso){
                            Permiso::findOrFail($id)->update([
                                'PRM_Nombre_Permiso' => $request->PRM_Nombre_Permiso,
                                'PRM_Slug_Permiso' => $slugPermiso,
                                'PRM_Menu_Permiso' => $request->has('PRM_Menu_Permiso'),
                                'PRM_Icono_Permiso' => $request->PRM_Icono_Permiso,
                                'PRM_Accion_Permiso' => $request->PRM_Accion_Permiso,
                                'PRM_Categoria_Permiso' => $request->PRM_Categoria_Permiso
                            ]);

                            return $this->vista(Lang::get('messages.PermissionUpdated'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'));
                        }
                        return response()->json(['mensaje'=>Lang::get('messages.ExistingPermission'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                    }
                    return response()->json(['mensaje'=>Lang::get('messages.IconRequired'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                }
                return response()->json(['mensaje'=>Lang::get('messages.ExistingRol'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                try {
                    Permiso::destroy($id);
                } catch (QueryException $ex) {
                    return response()->json(['mensaje'=>Lang::get('messages.PermissionNoDelete'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
                }
                return response()->json(['mensaje'=>Lang::get('messages.PermissionDelete'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo)
    {
        $permisos = $permisos = DB::table('TBL_Permiso as p')
            ->join('TBL_Categoria as c', 'c.id', 'p.PRM_Categoria_Permiso')
            ->select('c.*', 'p.*')
            ->orderBy('p.PRM_Nombre_Permiso')
            ->paginate(10);
        return response()->json(['view'=>view('theme.back.permisos.table-data')->with('permisos', $permisos)->render(), 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $permisos = $permisos = DB::table('TBL_Permiso as p')
                ->join('TBL_Categoria as c', 'c.id', 'p.PRM_Categoria_Permiso')
                ->select('c.*', 'p.*')
                ->orderBy('p.PRM_Nombre_Permiso')
                ->paginate(10);
            return view('theme.back.permisos.table-data', compact('permisos'))->render();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ordenarMenu(Request $request)
    {
        if($request->ajax()){
            $rol = Roles::findOrFail(session()->get('Usuario_Id'));
            if($rol && $rol->id == 1){
                $menu = Permiso::where('PRM_Menu_Permiso', 1)
                    ->orderBy('PRM_Orden_Menu_Permiso')
                    ->get();
                
                return view('theme.back.permisos.orden', compact('menu'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.AccessDenied'), 'titulo'=>Lang::get('messages.TaxMendez'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function guardarOrden(Request $request)
    {
        if($request->ajax()){
            $menus=json_decode($request->menu);
            foreach ($menus as $var => $value) {
                Permiso::where('id', $value->id)
                    ->update([
                        'PRM_Orden_Menu_Permiso' => $var + 1
                    ]);
            }
            
            return response()
                ->json(['mensaje' => Lang::get('messages.MenuModified'), 'TM' => Lang::get('messages.TaxMendez'), 'type' => 'success']);
        }
        return response()
            ->json(['mensaje' => Lang::get('messages.MenuError'), 'TM' => Lang::get('messages.TaxMendez'), 'type' => 'error']);
    }

    public function iconos()
    {
        try
        {
            $remplazo = array("\r", "\n");
            $material = array();
            foreach(file(storage_path('app').'/icons/material.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $material[] = $line;
            }

            $fa_solid = array();
            foreach(file(storage_path('app').'/icons/fa-solid.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $fa_solid[] = $line;
            }

            $fa_regular = array();
            foreach(file(storage_path('app').'/icons/fa-regular.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $fa_regular[] = $line;
            }

            $fa_brand = array();
            foreach(file(storage_path('app').'/icons/fa-brand.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $fa_brand[] = $line;
            }

            $ti_arrow = array();
            foreach(file(storage_path('app').'/icons/ti-arrows.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_arrow[] = $line;
            }

            $ti_app = array();
            foreach(file(storage_path('app').'/icons/ti-app.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_app[] = $line;
            }

            $ti_control = array();
            foreach(file(storage_path('app').'/icons/ti-control.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_control[] = $line;
            }

            $ti_text_editor = array();
            foreach(file(storage_path('app').'/icons/ti-text-editor.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_text_editor[] = $line;
            }

            $ti_layout = array();
            foreach(file(storage_path('app').'/icons/ti-layout.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_layout[] = $line;
            }

            $ti_brand = array();
            foreach(file(storage_path('app').'/icons/ti-brand.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $ti_brand[] = $line;
            }

            $control = array();
            foreach(file(storage_path('app').'/icons/control.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $control[] = $line;
            }

            $flag = array();
            foreach(file(storage_path('app').'/icons/flag.txt') as $line) {
                $line = str_replace($remplazo, "", $line);
                $flag[] = $line;
            }

            return view('theme.back.permisos.iconos',
                compact(
                    'material',
                    'fa_solid',
                    'fa_regular',
                    'fa_brand',
                    'ti_arrow',
                    'ti_app',
                    'ti_control',
                    'ti_text_editor',
                    'ti_layout',
                    'ti_brand',
                    'control',
                    'flag'
                )
            );
        }
        catch (FileNotFoundException $exception)
        {
            dd("No existe el archivo");
        }
    }
}
