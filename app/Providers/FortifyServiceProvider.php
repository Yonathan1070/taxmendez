<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Passport\Passport;
use App\Models\Entity\Usuarios;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView( fn () => view('theme.back.general.login'));
        
        Fortify::authenticateUsing(function (Request $request) {
            $user = Usuarios::from('TBL_Usuario as u')
                ->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.USR_Nombre_Usuario', $request->USR_Nombre_Usuario)
                ->select('ru.*', 'u.*')
                ->first();
    
            if ($user && Hash::check($request->password, $user->password)) {
                if($user->USR_RL_Estado){
                    $roles = Usuarios::find($user->id)->roles()->get();
                    if($roles->isNotEmpty()){
                        $user->setSession($roles->toArray());
                        return $user;
                    }
                }
                return false;
            }
            return false;
        });

        Passport::routes();
    }
}
