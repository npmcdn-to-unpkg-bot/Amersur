<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Distrito;

class DistritoRepo extends BaseRepo{

    public function getModel()
    {
        return new Distrito;
    }

}