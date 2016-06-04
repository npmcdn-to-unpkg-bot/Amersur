<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active');

            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_profiles', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('nombres');
            $table->string('apellidos');

            $table->integer('user_id')->unsigned();

            $table->timestamps();
        });

        Schema::create('password_resets', function(Blueprint $table)
        {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('configurations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('titulo');
            $table->string('dominio');
            $table->string('description');
            $table->text('keywords');
            $table->string('email');

            $table->integer('user_id')->nullable()->default(NULL);

            $table->timestamps();
        });

        Schema::create('sliders', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('moneda', ['dolar','soles']);
            $table->double('precio');
            $table->string('enlace');
            $table->boolean('publicar');
            $table->string('imagen');
            $table->string('imagen_carpeta');

            $table->integer('user_id')->nullable()->default(NULL);

            $table->timestamps();
        });

        Schema::create('contacto_mensajes', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email');
            $table->string('telefono');
            $table->boolean('telefono_whatsapp');
            $table->text('mensaje');
            $table->boolean('leido');
            $table->enum('type', ['contacto', 'sugerencia']);

            $table->integer('user_id')->nullable()->default(NULL);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('contacto_infos', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('mapa');
            $table->text('contenido');

            $table->timestamps();
        });

        Schema::create('social_media', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('facebook');
            $table->string('instagram');
            $table->string('google');
            $table->string('pinterest');
            $table->string('tumblr');
            $table->string('twitter');
            $table->string('youtube');

            $table->integer('user_id')->nullable()->default(NULL);

            $table->timestamps();
        });

        Schema::create('histories', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('tabla');
            $table->integer('tabla_id')->unsigned()->nullable();

            $table->integer('user_id')->nullable()->default(NULL);

            $table->enum('type', ['create','update', 'restore', 'delete']);
            $table->enum('opcion', ['text', 'file']);
            $table->text('descripcion');

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
        Schema::drop('users');
        Schema::drop('user_profiles');
        Schema::drop('password_resets');
        Schema::drop('configurations');
        Schema::drop('sliders');
        Schema::drop('contacto_mensajes');
        Schema::drop('contacto_infos');
        Schema::drop('social_media');
        Schema::drop('histories');
	}

}
