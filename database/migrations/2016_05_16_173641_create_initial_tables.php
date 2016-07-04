<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
         * INMUEBLES
         */
        Schema::create('inmuebles', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->string('titulo');
            $table->string('slug_url');
            $table->string('descripcion');
            $table->text('contenido');

            $table->integer('distrito_id');
            $table->enum('moneda', ['dolar','soles']);
            $table->integer('inmueble_tipo_id');

            $table->string('area_total',15);
            $table->double('precio_venta');
            $table->string('enlace');

            $table->boolean('publicar')->default(false);

            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::statement('ALTER TABLE inmuebles ADD FULLTEXT busqueda(titulo,descripcion)');

        Schema::create('inmueble_imagenes', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('inmueble_id');

            $table->string('imagen');
            $table->string('imagen_carpeta');

            $table->integer('orden');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inmueble_tipos', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('titulo');
            $table->string('slug_url');

            $table->timestamps();
            $table->softDeletes();
        });

        /*
         * PROYECTOS
         */
        Schema::create('proyectos', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('titulo');
            $table->string('slug_url');
            $table->string('descripcion');
            $table->text('contenido');

            $table->boolean('publicar')->default(false);

            $table->timestamp('published_at');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('proyecto_imagenes', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('proyecto_id');

            $table->string('imagen');
            $table->string('imagen_carpeta');

            $table->integer('orden');

            $table->timestamps();
            $table->softDeletes();
        });

        /*
         * AGENDA DE CONTACTOS
         */
        Schema::create('agenda_contactos', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email');
            $table->string('direccion');
            $table->string('telefono');
            $table->text('nota');

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
        Schema::table('inmuebles', function($table) {
            $table->dropIndex('busqueda');
        });

        Schema::drop('inmuebles');
        Schema::drop('inmueble_imagenes');
        Schema::drop('inmueble_tipos');
        Schema::drop('proyectos');
        Schema::drop('proyecto_imagenes');
        Schema::drop('agenda_contactos');
	}

}
