<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmpresaBannersTable.
 */
class CreateEmpresaBannersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_banners', function(Blueprint $table) {
            $table->increments('id');
			$table->string('banner');
			$table->string('site')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
			$table->integer('empresa_id')->unsigned();
			$table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
            $table->integer('situacao_id')->unsigned();//1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
            $table->timestamps();
		});

		Schema::table('empresa_banners', function($table){
			$table->foreign('empresa_id')->references('id')->on('empresas');
			$table->foreign('statu_id')->references('id')->on('status');
            $table->foreign('situacao_id')->references('id')->on('situacoes');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresa_banners');
	}
}
