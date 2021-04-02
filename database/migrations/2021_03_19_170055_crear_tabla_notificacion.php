<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Notificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('NTF_De_Notificacion');
            $table->foreign('NTF_De_Notificacion', 'FK_Notificacion_Usuario_De')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('NTF_Para_Notificacion');
            $table->foreign('NTF_Para_Notificacion', 'FK_Notificacion_Usuario_Para')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('NTF_Icono_Notificacion', 250)->nullable();
            $table->string('NTF_Titulo_Notificacion', 500)->nullable();
            $table->text('NTF_Mensaje_Notificacion')->nullable();
            $table->string('NTF_Tipo_Notificacion', 5)->nullable();
            $table->string('NTF_Nombre_Parametro_Notificacion', 250)->nullable();
            $table->string('NTF_Valor_Parametro_Notificacion', 250)->nullable();
            $table->longText('NTF_Atributos_Notificacion')->nullable();
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
        Schema::dropIfExists('TBL_Notificacion');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
