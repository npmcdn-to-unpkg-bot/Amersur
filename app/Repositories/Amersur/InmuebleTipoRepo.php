<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\InmuebleTipo;

class InmuebleTipoRepo extends BaseRepo {

    public function getModel()
    {
        return new InmuebleTipo;
    }
}