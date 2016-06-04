<?php namespace Amersur\Http\ViewComposers;

use Amersur\Entities\Admin\SocialMedia;
use Illuminate\Contracts\View\View;

use Amersur\Entities\Admin\Configuration;

class FrontendComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $comConfig = Configuration::where('id', 1)->first();
        $comSocial = SocialMedia::where('id', 1)->first();

        $view->with(['comConfig' => $comConfig, 'comSocial' => $comSocial]);
    }

}