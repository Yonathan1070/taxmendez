<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaControlDesinfeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Control_Desinfeccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('CTD_Fecha_Hora_Desinfeccion');
            $table->unsignedBigInteger('CTD_Automovil_Id');
            $table->foreign('CTD_Automovil_Id', 'FK_Control_Desinfeccion_Automovil')->references('id')->on('TBL_Automovil')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('CTD_Usuario_Id');
            $table->foreign('CTD_Usuario_Id', 'FK_Control_Desinfeccion_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->float('CTD_Temperatura_Control_Desinfeccion');
            $table->longText('CTD_Firma_Control_Desinfeccion');
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
        Schema::dropIfExists('TBL_Control_Desinfeccion');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
