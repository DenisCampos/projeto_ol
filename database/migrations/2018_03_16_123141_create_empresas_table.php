<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmpresasTable.
 */
class CreateEmpresasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('slug')->nullable();
			$table->string('email')->unique();
			$table->string('imagem1');
			$table->string('imagem2')->nullable();
			$table->string('imagem3')->nullable();
			$table->string('contato');
			$table->text('descricao');
			$table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('complemento')->nullable();
			$table->integer('pais_id')->unsigned()->nullable();
            $table->integer('estado_id')->unsigned()->nullable();
            $table->integer('cidade_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned();
			$table->string('site')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('instagram')->nullable();
			$table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
			$table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
            $table->integer('situacao_id')->unsigned();//1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
			$table->integer('destaque_id')->unsigned();//1 = publicacao normal, 2 = em destaque
			$table->enum('banner', [0, 1])->default(0);//0 = nao, 1 = sim
            $table->timestamps();
		});

		Schema::table('empresas', function($table){
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
		Schema::drop('empresas');
	}
}
