<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaConductorFijoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Usuario', function (Blueprint $table) {
            $table->boolean('USR_Conductor_Fijo_Usuario')->after('USR_Empresa_Id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Usuario', function (Blueprint $table) {
            $table->dropColumn(['USR_Conductor_Fijo_Usuario']);
        });
    }
}
