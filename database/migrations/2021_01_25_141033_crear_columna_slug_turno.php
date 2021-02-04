<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaSlugTurno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Turno', function (Blueprint $table) {
            $table->string('TRN_Slug_Turno', 500)->after('TRN_Nombre_Turno');
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
            $table->dropColumn(['TRN_Slug_Turno']);
        });
    }
}
