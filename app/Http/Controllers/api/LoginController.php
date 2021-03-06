<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Http\Requests\api\LoginRequest;
use App\Models\Entity\Permiso;
use App\Models\Entity\Usuarios;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $datos = $request->all();
        $validacion = new LoginRequest();
        $validator = Validator::make($datos, $validacion->rules(), $validacion->messages());
        if($validator->passes()){
            $user = Usuarios::from('TBL_Usuario as u')
                ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Nombre_Usuario', $request->USR_Nombre_Usuario)
                ->select('ru.*', 'u.*')
                ->first();
        
            if ($user) {
                if(Hash::check($request->password, $user->password)){
                    if($user->USR_RL_Estado){
                        $permiso = false;
                        $roles = Usuarios::find($user->id)->roles()->get();
                        
                        if($roles->isNotEmpty()){
                            foreach ($roles as $rol) {
                                if(Str::contains($rol->RL_Nombre_Rol, 'Admin')){
                                    $permiso = true;
                                    break;
                                }else{
                                    $permisos = Permiso::from('TBL_Permiso as p')
                                        ->join('TBL_Permiso_Usuario as pu', 'pu.PRM_USR_Permiso_Id', 'p.id')
                                        ->where('pu.PRM_USR_Usuario_Id', $user->id)
                                        ->where('p.PRM_Slug_Permiso', 'like', 'app')
                                        ->select('pu.*', 'p.*')
                                        ->first();
                                    
                                    if($permisos != null){
                                        $permiso = true;
                                    }
                                }
                            }
                            if($permiso){
                                //Create Token
                                $tokenAuth = $user->createToken('Personal Access Token');
                                $token = $tokenAuth->token;
                                $token->expires_at = Carbon::now()->addWeeks(1);

                                $token->save();
                                //End Section
                                //$user->setSession($roles->toArray());
                                $success['token'] = $tokenAuth->accessToken;
                                $success['token_type'] = 'Bearer ';
                                $success['expire_token'] = Carbon::parse($tokenAuth->token->expires_at)->toDateTimeString();
                                $success['usuario'] =  $user;

                                return $this->sendResponse($success, 'Login correcto.');
                            }
                            return $this->sendError('Permisos insuficientes, comuniquese con el administrador!', 200);
                        }
                    }
                    return $this->sendError('El usuario se encuentra inactivo!', 200);
                }
                return $this->sendError('Contraseña incorrecta!', 200);
            }
            return $this->sendError('Usuario no existe!', 200);
        }
        return $this->sendError($validator->errors()->first(), 200);
    }

    public function usuario(Request $request){
        return $this->sendResponse($request->user(), 'Completado correctamente.');
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return $this->sendResponse(null, 'Sesión terminada con éxito.');
    }
}
