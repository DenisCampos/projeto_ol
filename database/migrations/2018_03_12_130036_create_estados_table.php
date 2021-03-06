<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sigla')->nullable();
            $table->string('descricao');
            $table->string('slug')->nullable();
            $table->integer('pais_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('estados', function($table){
            $table->foreign('pais_id')->references('id')->on('paises');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
