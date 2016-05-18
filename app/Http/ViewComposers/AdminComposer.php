<?php namespace Amersur\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use Amersur\Entities\Admin\ContactoMensaje;

class AdminComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $comContactoMensaje = ContactoMensaje::where('leido', 0)->where('type', 'contacto')->orderBy('created_at', 'desc')->get();
        $comSugerencias = ContactoMensaje::where('leido', 0)->where('type', 'sugerencia')->orderBy('created_at', 'desc')->get();

        $view->with(['comContactoMensaje' => $comContactoMensaje, 'comSugerencias' => $comSugerencias]);
    }

}