<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarTipoDatoColumnaFotoAutomovil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Automovil', function (Blueprint $table) {
            DB::statement("ALTER TABLE TBL_Automovil MODIFY AUT_Foto_Automovil TEXT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Automovil', function (Blueprint $table) {
            DB::statement("ALTER TABLE TBL_Automovil MODIFY AUT_Foto_Automovil TEXT");
        });
    }
}
