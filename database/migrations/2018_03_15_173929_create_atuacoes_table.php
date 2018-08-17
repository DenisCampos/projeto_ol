<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAtuacoesTable.
 */
class CreateAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->string('descricao');
			$table->tinyInteger('tipo')->default(3); //1 - profissional, 2 - empresa, 3 - ambos
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
		Schema::drop('atuacoes');
	}
}
