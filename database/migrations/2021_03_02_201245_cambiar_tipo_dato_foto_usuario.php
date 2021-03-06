<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarTipoDatoFotoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Usuario', function (Blueprint $table) {
            DB::statement("ALTER TABLE TBL_Usuario MODIFY USR_Foto_Perfil_Usuario LONGTEXT");
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
            DB::statement("ALTER TABLE TBL_Usuario MODIFY USR_Foto_Perfil_Usuario TEXT");
        });
    }
}
