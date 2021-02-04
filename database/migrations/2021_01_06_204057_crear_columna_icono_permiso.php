<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaIconoPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Permiso', function (Blueprint $table) {
            $table->string('PRM_Icono_Permiso', 300)->after('PRM_Menu_Permiso')->nullable();
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
            $table->dropColumn(['PRM_Icono_Permiso']);
        });
    }
}
