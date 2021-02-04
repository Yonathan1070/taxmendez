<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaMensualidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Mensualidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('MNS_Automovil_Id');
            $table->foreign('MNS_Automovil_Id', 'FK_Mensualidad_Automovil')->references('id')->on('TBL_Automovil')->onDelete('restrict')->onUpdate('restrict');
            $table->string('MNS_Producido_Mensualidad', 30);
            $table->string('MNS_Gastos_Mensualidad', 30);
            $table->string('MNS_Kilometraje_Mensualidad', 50);
            $table->integer('MNS_Dias_Trabajados_Mensualidad');
            $table->date('MNS_Mes_Anio_Mensualidad');
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
        Schema::dropIfExists('TBL_Mensualidad');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
