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

Route::get('/upload/{folder}/{width}x{height}/{image}', ['as' => 'image.adaptiveResize', 'uses' => 'ImageController@adaptiveResize']);

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', function () { return view('frontend.index'); });
    Route::get('nosotros', function () { return view('frontend.nosotros'); });
    Route::get('servicios', function () { return view('frontend.servicios'); });
    Route::get('galerias', function () { return view('frontend.galeria'); });
    Route::get('testimonios', function () { return view('frontend.testimonios'); });

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

    });

    //SLIDER
    Route::resource('slider', 'SlidersController', ['only' => ['edit','update']]);

    //PRODUCTOS
    Route::resource('productos', 'ProductosController');
    Route::put('productos-destacado/{id}', ['as' => 'admin.productos.destacado', 'uses' => 'ProductosController@destacado']);
    Route::put('productos-oferta/{id}', ['as' => 'admin.productos.oferta', 'uses' => 'ProductosController@oferta']);
    Route::put('productos-publicar/{id}', ['as' => 'admin.productos.publicar', 'uses' => 'ProductosController@publicar']);
    Route::get('productos-price/{id}', ['as' => 'admin.productos.price', 'uses' => 'ProductosController@price']);
    Route::get('productos-history/{id}', ['as' => 'admin.productos.history', 'uses' => 'ProductosController@history']);
    Route::get('productos-deletes', ['as' => 'admin.productos.listsDeletes', 'uses' => 'ProductosController@listsDeletes']);
    Route::delete('productos-deletes/destroy/{id}', ['as' => 'admin.productos.listsDeletes.destroy', 'uses' => 'ProductosController@destroyTotal']);
    Route::post('productos-deletes/restore/{id}', ['as' => 'admin.productos.listsDeletes.restore', 'uses' => 'ProductosController@restore']);
    Route::match(['post', 'put'], 'productos-calcular-costo', ['as' => 'admin.productos.calcular.costo', 'uses' => 'ProductosController@calcularCosto']);

    Route::group(['prefix' => 'productos/images'], function(){
        Route::get('{producto}', ['as' => 'admin.productos.img.list', 'uses' => 'ProductosController@photosList' ]);
        Route::post('{producto}/order', ['as' => 'admin.productos.img.order', 'uses' => 'ProductosController@photosOrder' ]);
        Route::get('{producto}/upload', ['as' => 'admin.productos.img.create', 'uses' => 'ProductosController@photosCreate' ]);
        Route::post('{producto}/upload', ['as' => 'admin.productos.img.store', 'uses' => 'ProductosController@photosStore' ]);
        Route::delete('{producto}/delete/{id}', ['as' => 'admin.productos.img.delete', 'uses' => 'ProductosController@photosDelete' ]);
    });

    //PRODUCTOS - CATEGORIAS
    Route::resource('productos-category', 'ProductosCategoriesController');

    //PAGINAS
    Route::resource('pages', 'PagesController');

    //CATEGORIAS
    Route::resource('category', 'CategoriesController');

    //TAGS
    Route::resource('tag', 'TagsController');

    //GALERIA
    Route::group(['prefix' => 'gallery'], function(){

        //GALERIA DE VIDEOS
        Route::resource('video', 'GalleryVideosController');
        Route::get('video-deletes', ['as' => 'admin.gallery.video.listsDeletes', 'uses' => 'GalleryVideosController@listsDeletes']);
        Route::delete('video-deletes/destroy/{id}', ['as' => 'admin.gallery.video.listsDeletes.destroy', 'uses' => 'GalleryVideosController@destroyTotal']);
        Route::post('video-deletes/restore/{id}', ['as' => 'admin.gallery.video.listsDeletes.restore', 'uses' => 'GalleryVideosController@restore']);
        Route::post('video/url', ['as' => 'admin.gallery.video.slugUrl', 'uses' => 'GalleryVideosController@slugUrl']);

    });

    //SERVICIOS
    Route::resource('servicios', 'ServiciosController');

    //CONFIGURACION
    Route::get('config', ['as' => 'admin.config', 'uses' => 'ConfigsController@edit']);
    Route::put('config', ['as' => 'admin.config.update', 'uses' => 'ConfigsController@update']);

    //USUARIOS
    Route::resource('user', 'UsersController');
    Route::post('user/{user}/password', ['as' => 'admin.user.updatePassword', 'uses' => 'UsersController@updatePassword']);

    //CONTACTO - MENSAJES
    Route::resource('contacto/mensajes', 'ContactoMensajesController', ['only' => ['index','show']]);
    Route::resource('contacto/sugerencias', 'ContactoSugerenciasController', ['only' => ['index','show']]);

});