<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProfissionalAtuacoesTable.
 */
class CreateProfissionalAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profissional_atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('profissional_id')->unsigned();
			$table->integer('atuacao_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('profissional_atuacoes', function($table){
			$table->foreign('profissional_id')->references('id')->on('profissionais');
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
		Schema::drop('profissional_atuacoes');
	}
}
