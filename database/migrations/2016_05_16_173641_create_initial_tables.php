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
        Schema::create('posts', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->string('titulo');
            $table->string('slug_url');
            $table->string('descripcion');
            $table->text('contenido');
            $table->string('imagen');
            $table->string('imagen_carpeta');
            $table->string('video');
            $table->string('tags');

            $table->docuble('precio');

            $table->boolean('publicar')->default(false);

            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::statement('ALTER TABLE posts ADD FULLTEXT busqueda(titulo,descripcion)');

        Schema::create('post_images', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('post_id');

            $table->string('imagen');
            $table->string('imagen_carpeta');

            $table->integer('orden');

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
        Schema::table('posts', function($table) {
            $table->dropIndex('busqueda');
        });

        Schema::drop('posts');
        Schema::drop('post_images');
	}

}
