<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmpresaAtuacoesTable.
 */
class CreateEmpresaAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('empresa_id')->unsigned();
			$table->integer('atuacao_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('empresa_atuacoes', function($table){
			$table->foreign('empresa_id')->references('id')->on('empresas');
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
		Schema::drop('empresa_atuacoes');
	}
}
