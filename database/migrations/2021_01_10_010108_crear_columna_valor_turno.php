<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaValorTurno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Turno', function (Blueprint $table) {
            $table->double('TRN_Valor_Turno')->after('TRN_Descripcion_Turno')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Turno', function (Blueprint $table) {
            $table->dropColumn(['TRN_Valor_Turno']);
        });
    }
}
