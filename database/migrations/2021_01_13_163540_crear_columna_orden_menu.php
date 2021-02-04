<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaOrdenMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Permiso', function (Blueprint $table) {
            $table->integer('PRM_Orden_Menu_Permiso')->after('PRM_Menu_Permiso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Permiso', function (Blueprint $table) {
            $table->dropColumn(['PRM_Orden_Menu_Permiso']);
        });
    }
}
