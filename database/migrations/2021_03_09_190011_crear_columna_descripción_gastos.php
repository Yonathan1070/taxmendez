<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaDescripciónGastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Gastos', function (Blueprint $table) {
            $table->string('GST_Descripcion_Gasto')->nullable()->after('GST_Mes_Anio_Gasto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Gastos', function (Blueprint $table) {
            $table->dropColumn(['GST_Descripcion_Gasto']);
        });
    }
}
