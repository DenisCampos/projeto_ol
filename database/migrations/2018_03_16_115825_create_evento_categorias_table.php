<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEventoCategoriasTable.
 */
class CreateEventoCategoriasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evento_categorias', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('evento_id')->unsigned();
			$table->integer('categoria_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('evento_categorias', function($table){
			$table->foreign('evento_id')->references('id')->on('eventos');
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
		Schema::drop('evento_categorias');
	}
}
