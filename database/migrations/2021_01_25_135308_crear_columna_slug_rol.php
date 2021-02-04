<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaSlugRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Rol', function (Blueprint $table) {
            $table->string('RL_Slug_Rol', 500)->after('RL_Nombre_Rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Rol', function (Blueprint $table) {
            $table->dropColumn(['RL_Slug_Rol']);
        });
    }
}
