<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//CAMBIAR ANCHO Y ALTO DE IMAGEN
Route::get('/upload/{folder}/{width}x{height}/{image}', ['as' => 'image.adaptiveResize', 'uses' => 'ImageController@adaptiveResize']);

//CAMBIAR ANCHO DE IMAGNE
Route::get('/upload/{folder}/{width}/{image}', ['as' => 'image.withResize', 'uses' => 'ImageController@withResize']);

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', ['as' => 'frontend.index', 'uses' => 'FrontendController@index']);
    Route::get('nosotros', ['as' => 'frontend.nosotros', 'uses' => 'FrontendController@nosotros']);

    //INMUEBLES
    Route::get('inmueble/{id}-{url}', ['as' => 'frontend.inmueble', 'uses' => 'FrontendController@inmueble']);

    //INMUEBLES
    Route::get('inmuebles', ['as' => 'frontend.inmuebles', 'uses' => 'FrontendController@inmuebles']);

    //PROYECTOS
    Route::get('proyectos', ['as' => 'frontend.proyectos', 'uses' => 'FrontendController@proyectos']);

    //CONTACTO
    Route::get('contacto', ['as' => 'frontend.contacto.get', 'uses' => 'FrontendController@getContacto']);
    Route::post('contacto', ['as' => 'frontend.contacto.post', 'uses' => 'FrontendController@postContacto']);

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['namespace' => 'Auth'], function () {

    //LOGIN
    Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'AuthController@postLogin']);

    //REGISTRO
    Route::get('registro', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('registro', ['as' => 'auth.register', 'uses' => 'AuthController@postRegister']);

    //ACTIVAR CUENTA
    Route::get('active/{codigo}', ['as' => 'auth.active', 'uses' => 'AuthController@getActive']);

    //RECUPEAR CONTRASEÑA
    Route::get('login-password', ['as' => 'auth.login.password', 'uses' => 'PasswordController@getEmail']);
    Route::post('login-password', ['as' => 'auth.login.password', 'uses' => 'PasswordController@postEmail']);

    //RESTABLECER CONTRASEÑA
    Route::get('login-password/reset/{token}', 'PasswordController@getReset');
    Route::post('login-password/reset', 'PasswordController@postReset');

    //LOGOUT
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);

});


//ADMINISTRADOR
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

    Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@index']);

    //EMPRESA
    Route::group(['prefix' => 'company'], function(){

        //NOSOTROS
        Route::get('us', ['as' => 'admin.company.us.edit', 'uses' => 'CompanyController@usEdit']);
        Route::put('us', ['as' => 'admin.company.us.update', 'uses' => 'CompanyController@usUpdate']);

        //SOCIAL MEDIA
        Route::get('social', ['as' => 'admin.company.social.edit', 'uses' => 'CompanyController@socialEdit']);
        Route::put('social', ['as' => 'admin.company.social.update', 'uses' => 'CompanyController@socialUpdate']);

        //CONTACTO
        Route::get('contacto', ['as' => 'admin.contacto', 'uses' => 'ContactoController@edit']);
        Route::put('contacto', ['as' => 'admin.contacto.update', 'uses' => 'ContactoController@update']);

        //EMPRESA
        Route::get('empresa', ['as' => 'admin.empresa', 'uses' => 'EmpresaController@edit']);
        Route::put('empresa', ['as' => 'admin.empresa.update', 'uses' => 'EmpresaController@update']);

    });

    //SLIDER
    Route::resource('slider', 'SlidersController');
    Route::put('slider-publicar/{id}', ['as' => 'admin.slider.publicar', 'uses' => 'SlidersController@publicar']);

    //PRODUCTOS
    Route::resource('inmuebles', 'InmueblesController');
    Route::put('inmuebles-publicar/{id}', ['as' => 'admin.inmuebles.publicar', 'uses' => 'InmueblesController@publicar']);

    Route::group(['prefix' => 'inmuebles/images'], function(){
        Route::get('{inmueble}', ['as' => 'admin.inmuebles.img.list', 'uses' => 'InmueblesController@photosList' ]);
        Route::post('{inmueble}/order', ['as' => 'admin.inmuebles.img.order', 'uses' => 'InmueblesController@photosOrder' ]);
        Route::get('{inmueble}/upload', ['as' => 'admin.inmuebles.img.create', 'uses' => 'InmueblesController@photosCreate' ]);
        Route::post('{inmueble}/upload', ['as' => 'admin.inmuebles.img.store', 'uses' => 'InmueblesController@photosStore' ]);
        Route::delete('{inmueble}/delete/{id}', ['as' => 'admin.inmuebles.img.delete', 'uses' => 'InmueblesController@photosDelete' ]);
    });

    //PRODUCTOS - CATEGORIAS
    Route::resource('inmueble-tipos', 'InmuebleTiposController');

    //CONFIGURACION
    Route::get('config', ['as' => 'admin.config', 'uses' => 'ConfigsController@edit']);
    Route::put('config', ['as' => 'admin.config.update', 'uses' => 'ConfigsController@update']);

    //USUARIOS
    Route::resource('user', 'UsersController');
    Route::post('user/{user}/password', ['as' => 'admin.user.updatePassword', 'uses' => 'UsersController@updatePassword']);

    //CONTACTO - MENSAJES
    Route::resource('contacto/mensajes', 'ContactoMensajesController', ['only' => ['index','show']]);

    //AGENDA DE CLIENTE
    Route::resource('agenda', 'AgendaController');

    //PROYECTOS
    Route::resource('proyectos', 'ProyectosController');

});