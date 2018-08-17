<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBannersPrincipaisTable.
 */
class CreateBannersPrincipaisTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banners_principais', function(Blueprint $table) {
            $table->increments('id');
			$table->string('imagem');
			$table->string('link')->nullable();
			$table->string('titulo')->nullable();
			$table->text('descricao')->nullable();
			$table->integer('statu_id')->unsigned();//1 = despublicado, 2 = publicado
            $table->timestamps();
		});

		
		Schema::table('banners_principais', function($table){
			$table->foreign('statu_id')->references('id')->on('status');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banners_principais');
	}
}
