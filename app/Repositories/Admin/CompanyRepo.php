<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Company;

class CompanyRepo extends BaseRepo{

    public function getModel()
    {
        return new Company;
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->paginate();
    }
}