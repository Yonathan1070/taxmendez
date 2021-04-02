<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaCanalNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Canal_Notificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CNT_Nombre_Canal_Notificacion', 250);
            $table->text('CNT_Descripcion_Canal_Notificacion');
            $table->string('CNT_Nick_Canal_Notificacion', 250);
            $table->boolean('CNT_Habilitado_Canal_Notificacion');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
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
        Schema::dropIfExists('TBL_Canal_Notificacion');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
