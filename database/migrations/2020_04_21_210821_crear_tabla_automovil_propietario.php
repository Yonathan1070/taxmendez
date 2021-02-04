<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaAutomovilPropietario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Automovil_Propietario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('AUT_PRP_Automovil_Id');
            $table->foreign('AUT_PRP_Automovil_Id', 'FK_Automovil_Propietario_Automovil')->references('id')->on('TBL_Automovil')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('AUT_PRP_Propietario_Id');
            $table->foreign('AUT_PRP_Propietario_Id', 'FK_Automovil_Propietario_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('AUT_PRO_Tarjeta_Propiedad_Automovil', 50)->nullable();
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
        Schema::dropIfExists('TBL_Automovil_Propietario');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
