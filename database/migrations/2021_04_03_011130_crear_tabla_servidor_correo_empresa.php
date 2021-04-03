<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaServidorCorreoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Servidor_Correo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('SRC_Driver_Servidor')->nullable();
            $table->text('SRC_Host_Servidor')->nullable();
            $table->text('SRC_Puerto_Servidor')->nullable();
            $table->text('SRC_Nombre_Usuario_Servidor')->nullable();
            $table->text('SRC_Password_Servidor')->nullable();
            $table->text('SRC_Encriptacion_Servidor')->nullable();
            $table->text('SRC_Direccion_De_Servidor')->nullable();
            $table->text('SRC_Nombre_De_Servidor')->nullable();
            $table->unsignedBigInteger('SRC_Empresa_Servidor');
            $table->foreign('SRC_Empresa_Servidor', 'FK_Servidor_Correo_Empresa')->references('id')->on('TBL_Empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
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
        Schema::dropIfExists('TBL_Servidor_Correo');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
