<?php namespace Amersur\Providers;

use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		\View::composers([
            'Amersur\Http\ViewComposers\FrontendComposer' => ['layouts.frontend', 'partials.social', 'frontend.inmuebles-nota', 'frontend.proyectos-nota']
        ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
