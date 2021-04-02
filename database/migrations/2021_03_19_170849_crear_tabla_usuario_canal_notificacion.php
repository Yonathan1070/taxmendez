<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarioCanalNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Usuario_Canal_Notificacion', function (Blueprint $table) {
            $table->unsignedBigInteger('USR_CNT_Usuario_Id');
            $table->foreign('USR_CNT_Usuario_Id', 'FK_Usuario_Canal_Notificacion_Usuario')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('USR_CNT_Canal_Id');
            $table->foreign('USR_CNT_Canal_Id', 'FK_Usuario_Canal_Notificacion_Canal')->references('id')->on('TBL_Canal_Notificacion')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::dropIfExists('TBL_Usuario_Canal_Notificacion');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
