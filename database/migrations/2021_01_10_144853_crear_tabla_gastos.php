<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaGastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('GST_Automovil_Id');
            $table->foreign('GST_Automovil_Id', 'FK_Automovil_Gastos_Automovil')->references('id')->on('TBL_Automovil')->onDelete('restrict')->onUpdate('restrict');
            $table->date('GST_Mes_Anio_Gasto');
            $table->integer('GST_Costo_Gasto');
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
        Schema::dropIfExists('TBL_Gastos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
