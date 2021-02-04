<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Permiso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PRM_Nombre_Permiso', 50);
            $table->string('PRM_Slug_Permiso', 100);
            $table->boolean('PRM_Menu_Permiso')->default(0);
            $table->text('PRM_Accion_Permiso');
            $table->unsignedBigInteger('PRM_Categoria_Permiso');
            $table->foreign('PRM_Categoria_Permiso', 'FK_Permiso_Categoria')->references('id')->on('TBL_Categoria')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Permiso');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
