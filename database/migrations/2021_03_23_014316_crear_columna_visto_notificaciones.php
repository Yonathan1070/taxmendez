<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaVistoNotificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Notificacion', function (Blueprint $table) {
            $table->boolean('NTF_Visto_Notificacion')->after('NTF_Atributos_Notificacion')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Notificacion', function (Blueprint $table) {
            $table->dropColumn(['NTF_Visto_Notificacion']);
        });
    }
}
