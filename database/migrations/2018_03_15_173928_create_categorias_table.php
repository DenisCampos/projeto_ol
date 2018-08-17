<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCategoriasTable.
 */
class CreateCategoriasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function(Blueprint $table) {
            $table->increments('id');
			$table->string('descricao');
			$table->tinyInteger('tipo')->default(15); //1 - Para Você, 2 - Para Profissional, 3 - Para Empresa, 4 - Você/Profissional, 5 - Você/Empresa, 6. Profissional/Empresa, 7 - todos , 8 - Você/Evento, 9 - Profissional/Evento, 10 - Empresa/Evento,11 - Você/Profissional/Evento ,12 - Você/Empresa/Evento,13 -Profissional/Empresa/Evento ,14 - todos 
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorias');
	}
}
