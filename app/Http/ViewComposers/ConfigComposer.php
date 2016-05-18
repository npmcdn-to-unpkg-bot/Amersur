<?php namespace Amersur\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use Amersur\Entities\Admin\Configuration;

class ConfigComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $comConfig = Configuration::where('id', 1)->first();

        $view->with(['comConfig' => $comConfig]);
    }

}