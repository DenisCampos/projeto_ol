<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserInteressesTable.
 */
class CreateUserInteressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_interesses', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('categoria_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('user_interesses', function($table){
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('categoria_id')->references('id')->on('categorias');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_interesses');
	}
}
