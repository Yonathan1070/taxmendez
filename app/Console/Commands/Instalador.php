<?php

namespace App\Console\Commands;

use App\Models\Entity\Categoria;
use App\Models\Entity\Empresa;
use App\Models\Entity\Permiso;
use App\Models\Entity\Roles;
use App\Models\Entity\Turno;
use App\Models\Entity\UsuarioRol;
use App\Models\Entity\Usuarios;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Instalador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taxmendez:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando ejecuta el instalador inicial de TaxMendez';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = $this->verificar();
        if($result == 100){
            $this->error('Instalador ya ha sido ejecutado!');
        }else if($result == 101){
            $this->warn('Empresa existe.');
            $rol = $this->crearRolSuperAdmin();
            $empresa = Empresa::where('EMP_Nombre_Empresa', 'TaxMendez')->first();
            $usuario = $this->crearUsuarioSuperAdmin($empresa->id);
            $this->line('Datos de usuario y rol insertados.');
            //Relación
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        }else if($result==102){
            $this->warn('Rol existe.');
            $empresa = $this->crearEmpresa();
            $usuario = $this->crearUsuarioSuperAdmin($empresa['id']);
            $this->line('Datos de empresa y usuario insertados.');
            //Relación
            $rol = Roles::where('RL_Nombre_Rol', 'Super Administrador')->first();
            $this->relacionUsuarioRol($usuario->id, $rol->id);
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        } else if($result == 103){
            $this->warn('Empresa, usuario y rol existen.');
            //Relación
            $rol = Roles::where('RL_Nombre_Rol', 'Super Administrador')->first();
            $usuario = Usuarios::where('USR_Nombre_Usuario', 'taxAdmin')
                ->where('USR_Documento_Usuario', '1')
                ->first();
            $this->relacionUsuarioRol($usuario->id, $rol->id);
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        } else if($result == 104){
            $this->warn('Empresa y usuario existen.');
            //Relación
            $rol = $this->crearRolSuperAdmin();
            $this->line('Datos del rol insertados.');
            $usuario = Usuarios::where('USR_Nombre_Usuario', 'taxAdmin')
                ->where('USR_Documento_Usuario', '1')
                ->first();
            $this->relacionUsuarioRol($usuario->id, $rol->id);
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        } else if($result == 105){
            $this->warn('Empresa y rol existen.');
            //Relación
            $empresa = Empresa::where('EMP_Nombre_Empresa', 'TaxMendez')->first();
            $rol = Roles::where('RL_Nombre_Rol', 'Super Administrador')->first();
            $usuario = $this->crearUsuarioSuperAdmin($empresa['id']);
            $this->line('Datos del usuario insertados.');
            $this->relacionUsuarioRol($usuario->id, $rol->id);
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        } else{
            $empresa = $this->crearEmpresa();
            $usuario = $this->crearUsuarioSuperAdmin($empresa['id']);
            $rol = $this->crearRolSuperAdmin();
            $this->line('Datos insertados.');
            //Relación
            $this->relacionUsuarioRol($usuario->id, $rol->id);
            $this->line('Relación usuario rol realizada.');
            $this->line('Instalador ejecutado satisfactoriamente.');
        }
        $this->line('Relación usuario rol realizada.');
        $this->crearCategoria();
        $this->crearPermisos();
        $this->crearRoles();
        $this->crearTurnos();
    }

    private function verificar(){
        $rol = Roles::where('RL_Nombre_Rol', 'Super Administrador')->first();
        $usuario = Usuarios::where('USR_Nombre_Usuario', 'taxAdmin')
            ->where('USR_Documento_Usuario', '1')
            ->first();
        $empresa = Empresa::where('EMP_Nombre_Empresa', 'TaxMendez')->first();
        if($rol && $usuario && $empresa){
            $relacion = UsuarioRol::where('USR_RL_Usuario_Id', $usuario->id)
                ->where('USR_RL_Rol_Id', $rol->id)
                ->first();
            if(!$relacion){
                return 103;
            }
            return 100;
        }
        if($empresa && !$usuario && !$rol){
            return 101;
        }
        if($rol && !$empresa && !$usuario){
            return 102;
        }
        if($empresa && $usuario && !$rol){
            return 104;
        }
        if($empresa && !$usuario && $rol){
            return 105;
        }
        return 0;
    }

    private function crearEmpresa(){
        return Empresa::create([
            'EMP_Nombre_Empresa' => 'TaxMendez',
            'EMP_NIT_Empresa' => 'NN',
            'EMP_Telefono_Empresa'  => '0000000',
            'EMP_Direccion_Empresa' => 'Cll 5 # 13-18',
            'EMP_Correo_Empresa' => 'taxmendez@mail.com'
        ]);
    }

    private function crearRolSuperAdmin(){
        return Roles::create([
            'RL_Nombre_Rol' => 'Super Administrador',
            'RL_Slug_Rol' => 'super_administrador',
            'RL_Descripcion_Rol' => 'Super admin del sistema'
        ]);
    }

    private function crearUsuarioSuperAdmin($empresaId){
        return Usuarios::create([
            'USR_Documento_Usuario' => '1',
            'USR_Nombres_Usuario' => 'Super',
            'USR_Apellidos_Usuario'  => 'Admin',
            'USR_Nombre_Usuario' => 'taxAdmin',
            'password' => Hash::make('taxAdmin'),
            'USR_Empresa_Id' => $empresaId
        ]);
    }

    private function relacionUsuarioRol($usuarioId, $rolId){
        return UsuarioRol::create([
            'USR_RL_Usuario_Id' => $usuarioId,
            'USR_RL_Rol_Id' => $rolId,
            'USR_RL_Estado' => 1
        ]);
    }

    private function crearCategoria(){
        Categoria::create([
            'CAT_Nombre_Categoria' => 'General',
            'CAT_Nick_Categoria' => 'General'
        ]);
    }

    private function crearPermisos(){
        Permiso::create([
            'PRM_Nombre_Permiso' => 'Usuarios',
            'PRM_Slug_Permiso' => 'usuarios',
            'PRM_Menu_Permiso' => 1,
            'PRM_Icono_Permiso' => 'mdi mdi-account',
            'PRM_Accion_Permiso' => 'usuarios',
            'PRM_Categoria_Permiso' => 1
        ]);

        Permiso::create([
            'PRM_Nombre_Permiso' => 'Roles',
            'PRM_Slug_Permiso' => 'roles',
            'PRM_Menu_Permiso' => 1,
            'PRM_Icono_Permiso' => 'mdi mdi-account-search',
            'PRM_Accion_Permiso' => 'roles',
            'PRM_Categoria_Permiso' => 1
        ]);

        Permiso::create([
            'PRM_Nombre_Permiso' => 'Automoviles',
            'PRM_Slug_Permiso' => 'automoviles',
            'PRM_Menu_Permiso' => 1,
            'PRM_Icono_Permiso' => 'mdi mdi-taxi',
            'PRM_Accion_Permiso' => 'automoviles',
            'PRM_Categoria_Permiso' => 1
        ]);

        Permiso::create([
            'PRM_Nombre_Permiso' => 'Balance',
            'PRM_Slug_Permiso' => 'balance',
            'PRM_Menu_Permiso' => 0,
            'PRM_Accion_Permiso' => 'balance',
            'PRM_Categoria_Permiso' => 1
        ]);

        Permiso::create([
            'PRM_Nombre_Permiso' => 'Turnos',
            'PRM_Slug_Permiso' => 'turnos',
            'PRM_Menu_Permiso' => 1,
            'PRM_Icono_Permiso' => 'mdi mdi-calendar-clock',
            'PRM_Accion_Permiso' => 'turnos',
            'PRM_Categoria_Permiso' => 1
        ]);

        Permiso::create([
            'PRM_Nombre_Permiso' => 'Propietarios',
            'PRM_Slug_Permiso' => 'propietarios',
            'PRM_Menu_Permiso' => 0,
            'PRM_Accion_Permiso' => 'propietarios',
            'PRM_Categoria_Permiso' => 1
        ]);
    }

    private function crearRoles(){
        Roles::create([
            'RL_Nombre_Rol' => 'Conductor',
            'RL_Slug_Rol' => 'conductor',
            'RL_Descripcion_Rol' => 'Conductor'
        ]);

        Roles::create([
            'RL_Nombre_Rol' => 'Propietario',
            'RL_Slug_Rol' => 'propietario',
            'RL_Descripcion_Rol' => 'Propietario'
        ]);
    }

    private function crearTurnos(){
        Turno::create([
            'TRN_Nombre_Turno' => 'Día',
            'TRN_Slug_Turno' => 'dia',
            'TRN_Descripcion_Turno' => 'Día',
            'TRN_Valor_Turno' => 1
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => 'Noche',
            'TRN_Slug_Turno' => 'noche',
            'TRN_Descripcion_Turno' => 'Noche',
            'TRN_Valor_Turno' => 1
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => '1/2 Turno Día',
            'TRN_Slug_Turno' => '12_turno_dia',
            'TRN_Descripcion_Turno' => '1/2 Turno Día',
            'TRN_Valor_Turno' => 0.5
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => '1/2 Turno Noche',
            'TRN_Slug_Turno' => '12_turno_noche',
            'TRN_Descripcion_Turno' => '1/2 Turno Noche',
            'TRN_Valor_Turno' => 0.5
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => 'Pagó Turno Día',
            'TRN_Slug_Turno' => 'pago_turno_dia',
            'TRN_Descripcion_Turno' => 'Pagó Turno Día',
            'TRN_Valor_Turno' => 0
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => 'Pagó Turno Noche',
            'TRN_Slug_Turno' => 'pago_turno_noche',
            'TRN_Descripcion_Turno' => 'Pagó Turno Noche',
            'TRN_Valor_Turno' => 0
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => 'No se trabajó Día',
            'TRN_Slug_Turno' => 'no_se_trabajo_dia',
            'TRN_Descripcion_Turno' => 'No se trabajó Día',
            'TRN_Valor_Turno' => 0
        ]);

        Turno::create([
            'TRN_Nombre_Turno' => 'No se trabajó Noche',
            'TRN_Slug_Turno' => 'no_se_trabajo_noche',
            'TRN_Descripcion_Turno' => 'No se trabajó Noche',
            'TRN_Valor_Turno' => 0.5
        ]);
    }
}
