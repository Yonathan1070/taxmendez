<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearNuevasColumnasIdioma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Idioma', function (Blueprint $table) {
            $table->string('IDM_Short_Alias_Idioma', 5)->after('IDM_Nombre_Idioma');
            $table->string('IDM_Long_Alias_Idioma', 10)->after('IDM_Short_Alias_Idioma');
            $table->string('IDM_Nick_Idioma', 50)->after('IDM_Long_Alias_Idioma');
            $table->dropColumn(['IDM_Terminacion_Idioma']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Idioma', function (Blueprint $table) {
            $table->dropColumn(['IDM_Short_Alias_Idioma']);
            $table->dropColumn(['IDM_Long_Alias_Idioma']);
            $table->dropColumn(['IDM_Nick_Idioma']);
            $table->string('IDM_Terminacion_Idioma', 10)->after('IDM_Nombre_Idioma');
        });
    }
}
