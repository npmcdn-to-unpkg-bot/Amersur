<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicios', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('titulo');
            $table->string('slug_url');
            $table->string('descripcion');
            $table->text('contenido');

            $table->string('imagen');
            $table->string('imagen_carpeta');

            $table->boolean('publicar')->default(false);

            $table->timestamp('published_at');

            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servicios');
	}

}