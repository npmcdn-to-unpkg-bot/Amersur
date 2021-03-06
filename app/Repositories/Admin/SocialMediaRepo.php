<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\SocialMedia;

class SocialMediaRepo extends BaseRepo{

    public function getModel()
    {
        return new SocialMedia;
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->paginate();
    }
}