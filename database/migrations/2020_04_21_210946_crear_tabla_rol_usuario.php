<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaRolUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Rol_Usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('USR_RL_Usuario_Id');
            $table->foreign('USR_RL_Usuario_Id', 'FK_Usuarios_Roles_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('USR_RL_Rol_Id');
            $table->foreign('USR_RL_Rol_Id', 'FK_Usuarios_Roles_Rol')->references('id')->on('TBL_Rol')->onDelete('restrict')->onUpdate('restrict');
            $table->boolean('USR_RL_Estado');
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::dropIfExists('TBL_Rol_Usuario');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
