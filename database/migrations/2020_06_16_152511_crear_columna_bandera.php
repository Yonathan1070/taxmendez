<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaBandera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Idioma', function (Blueprint $table) {
            $table->text('IDM_Bandera_Idioma')->after('IDM_Terminacion_Idioma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Idioma', function (Blueprint $table){
            $table->dropColumn('IDM_Bandera_Idioma');
        });
    }
}
