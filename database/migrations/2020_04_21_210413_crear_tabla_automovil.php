<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaAutomovil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Automovil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AUT_Placa_Automovil', 30)->unique();
            $table->integer('AUT_Numero_Interno_Automovil')->unique();
            $table->date('AUT_Fecha_Vencimiento_Soat_Automovil');
            $table->date('AUT_Fecha_Vencimiento_Seguro_Actual_Automovil');
            $table->date('AUT_Fecha_Vencimiento_Seguro_Extracontractual_Automovil');
            $table->unsignedBigInteger('AUT_Empresa_Id');
            $table->foreign('AUT_Empresa_Id', 'FK_Automovil_Empresa')->references('id')->on('TBL_Empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->text('AUT_Foto_Automovil')->nullable();
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
        Schema::dropIfExists('TBL_Automovil');
    }
}
