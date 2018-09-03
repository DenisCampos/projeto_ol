<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubAtuacoesTable.
 */
class CreateSubAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->string('descricao');
			$table->string('slug')->nullable();
			$table->integer('atuacao_id')->unsigned();
			$table->tinyInteger('tipo')->default(3);; //1 - profissional, 2 - empresa, 3 - ambos
            $table->timestamps();
		});

		Schema::table('sub_atuacoes', function($table){
            $table->foreign('atuacao_id')->references('id')->on('atuacoes');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_atuacoes');
	}
}
