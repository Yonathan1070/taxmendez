<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaPermisoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Permiso_Usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('PRM_USR_Usuario_Id');
            $table->foreign('PRM_USR_Usuario_Id', 'FK_Permiso_Usuario_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('PRM_USR_Permiso_Id');
            $table->foreign('PRM_USR_Permiso_Id', 'FK_Permiso_Usuario_Permiso')->references('id')->on('TBL_Permiso')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Permiso_Usuario');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
