<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCursoCategoriasTable.
 */
class CreateCursoCategoriasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curso_categorias', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('curso_id')->unsigned();
			$table->integer('categoria_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('curso_categorias', function($table){
			$table->foreign('curso_id')->references('id')->on('cursos');
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
		Schema::drop('curso_categorias');
	}
}
