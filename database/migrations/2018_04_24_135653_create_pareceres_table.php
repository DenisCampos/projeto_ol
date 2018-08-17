<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePareceresTable.
 */
class CreatePareceresTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pareceres', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tipo');//1 = profissional, 2 = empresa, 3 = cruso, 4 = evento
			$table->integer('id_tipo');
			$table->integer('user_id')->unsigned();
			$table->text('parecer');
			$table->integer('situacao_id')->unsigned();//1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
			$table->enum('visualizou', [0, 1])->default(0);//0 = não, 1 = sim
            $table->timestamps();
		});

		Schema::table('pareceres', function($table){
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('pareceres');
	}
}
