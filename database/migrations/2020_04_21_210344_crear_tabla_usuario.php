<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('USR_Tipo_Documento_Usuario', 30)->nullable();
            $table->string('USR_Documento_Usuario', 50)->unique();
            $table->date('USR_Fecha_Vencimiento_Licencia_Usuario')->nullable();
            $table->string('USR_Nombres_Usuario', 50);
            $table->string('USR_Apellidos_Usuario', 50);
            $table->date('USR_Fecha_Nacimiento_Usuario')->nullable();
            $table->string('USR_Direccion_Residencia_Usuario', 100)->nullable();
            $table->string('USR_Telefono_Usuario', 20)->nullable();
            $table->string('USR_Correo_Usuario', 100)->nullable();
            $table->string('USR_Nombre_Usuario', 15);
            $table->text('password');
            $table->text('USR_Foto_Perfil_Usuario')->nullable();
            $table->unsignedBigInteger('USR_Empresa_Id');
            $table->foreign('USR_Empresa_Id', 'FK_Usuario_Empresa')->references('id')->on('TBL_Empresa')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Usuario');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
