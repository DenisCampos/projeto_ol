<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProfissionalSubAtuacoesTable.
 */
class CreateProfissionalSubAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profissional_sub_atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('profissional_id')->unsigned();
			$table->integer('subatuacao_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('profissional_sub_atuacoes', function($table){
			$table->foreign('profissional_id')->references('id')->on('profissionais');
			$table->foreign('subatuacao_id')->references('id')->on('sub_atuacoes');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profissional_sub_atuacoes');
	}
}
