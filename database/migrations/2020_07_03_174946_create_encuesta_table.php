<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEncuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encuesta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->longText('respuesta');
			$table->string('idempresa',20);
			$table->string('idsolicitud',20);
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
		Schema::drop('encuesta');
	}

}
