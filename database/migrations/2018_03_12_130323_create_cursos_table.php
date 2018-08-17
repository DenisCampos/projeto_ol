<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('sub_titulo')->nullable();
            $table->text('descricao');
            $table->string('imagem1');
            $table->string('imagem2')->nullable();
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_fim')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            $table->integer('estado_id')->unsigned()->nullable();
            $table->integer('cidade_id')->unsigned()->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('contato')->nullable();;
            $table->string('investimento')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('site')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('link')->nullable();
            $table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
            $table->integer('situacao_id')->unsigned();//1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
            $table->integer('destaque_id')->unsigned();//1 = publicacao normal, 2 = em destaque
            $table->timestamps();
        });

        Schema::table('cursos', function($table){
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('statu_id')->references('id')->on('status');
            $table->foreign('situacao_id')->references('id')->on('situacoes');
            $table->foreign('destaque_id')->references('id')->on('destaques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
