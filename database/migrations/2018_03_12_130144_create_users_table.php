<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('sexo')->nullable();
            $table->string('contato')->nullable();
            $table->integer('pais_id')->unsigned()->nullable();;
            $table->integer('estado_id')->unsigned()->nullable();;
            $table->integer('cidade_id')->unsigned()->nullable();;
            $table->integer('tipo')->default(0);
            $table->integer('aceitaCO')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function($table){
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
