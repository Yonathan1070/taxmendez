<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Control', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CTRL_Nombre_Control', 100);
            $table->unsignedBigInteger('CTRL_Formulario_Id');
            $table->foreign('CTRL_Formulario_Id', 'FK_Control_Formulario')->references('id')->on('TBL_Formulario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('CTRL_Idioma_Id');
            $table->foreign('CTRL_Idioma_Id', 'FK_Control_Idioma')->references('id')->on('TBL_Idioma')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Control');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
