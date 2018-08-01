<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComunidadIdFkToAsistidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            $table->integer('comunidad_id')->unsigned();
            $table->foreign('comunidad_id')->references('id')->on('comunidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            //
        });
    }
}
