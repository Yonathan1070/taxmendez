<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaLogoTextoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Empresa', function (Blueprint $table) {
            $table->longText('EMP_Logo_Texto_Empresa')->after('EMP_Logo_Empresa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Empresa', function (Blueprint $table) {
            $table->dropColumn(['EMP_Logo_Texto_Empresa']);
        });
    }
}
