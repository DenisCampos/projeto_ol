<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePostCategoriasTable.
 */
class CreatePostCategoriasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_categorias', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->integer('categoria_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('post_categorias', function($table){
			$table->foreign('post_id')->references('id')->on('posts');
			$table->foreign('categoria_id')->references('id')->on('categorias');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_categorias');
	}
}
