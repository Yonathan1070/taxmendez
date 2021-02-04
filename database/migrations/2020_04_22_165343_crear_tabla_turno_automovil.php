<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaTurnoAutomovil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Usuario_Automovil_Turno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('TRN_AUT_Automovil_Id');
            $table->foreign('TRN_AUT_Automovil_Id', 'FK_Turno_Automovil')->references('id')->on('TBL_Automovil')->onDelete('restrict')->onUpdate('restrict');
            $table->string('TRN_AUT_Kilometraje_Turno', 50);
            $table->string('TRN_AUT_Kilometros_Andados_Turno', 50);
            $table->string('TRN_AUT_Producido_Turno', 30);
            $table->unsignedBigInteger('TRN_AUT_Usuario_Turno_Id');
            $table->foreign('TRN_AUT_Usuario_Turno_Id', 'FK_Turno_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->date('TRN_AUT_Fecha_Turno');
            $table->unsignedBigInteger('TRN_AUT_Turno_Id');
            $table->foreign('TRN_AUT_Turno_Id', 'FK_Turno_Automovil_Turno')->references('id')->on('TBL_Turno')->onDelete('restrict')->onUpdate('restrict');
            $table->text('TRN_AUT_Observacion_Turno_Seleccionado')->nullable();
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
        Schema::dropIfExists('TBL_Turno_Automovil');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
