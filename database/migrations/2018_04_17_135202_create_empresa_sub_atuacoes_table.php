<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmpresaSubAtuacoesTable.
 */
class CreateEmpresaSubAtuacoesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_sub_atuacoes', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('empresa_id')->unsigned();
			$table->integer('subatuacao_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('empresa_sub_atuacoes', function($table){
			$table->foreign('empresa_id')->references('id')->on('empresas');
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
		Schema::drop('empresa_sub_atuacoes');
	}
}
