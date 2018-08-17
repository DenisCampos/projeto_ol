<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateComentariosTable.
 */
class CreateComentariosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios', function(Blueprint $table) {
            $table->increments('id');
			$table->text('descricao');
			$table->integer('user_id')->unsigned();
			$table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
			$table->integer('post_id')->unsigned();
			$table->integer('comentario_id')->unsigned()->nullable();
            $table->timestamps();
		});

		Schema::table('comentarios', function($table){
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('statu_id')->references('id')->on('status');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('comentario_id')->references('id')->on('comentarios');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comentarios');
	}
}
