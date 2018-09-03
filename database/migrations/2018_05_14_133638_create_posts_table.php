<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePostsTable.
 */
class CreatePostsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
			$table->string('titulo');
			$table->string('slug')->nullable();
            $table->text('descricao');
            $table->string('imagem1');
			$table->string('imagem2')->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
            $table->integer('situacao_id')->unsigned();//1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
            $table->integer('destaque_id')->unsigned();//1 = publicacao normal, 2 = em destaque
            $table->timestamps();
		});

		Schema::table('posts', function($table){
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
		Schema::drop('posts');
	}
}
