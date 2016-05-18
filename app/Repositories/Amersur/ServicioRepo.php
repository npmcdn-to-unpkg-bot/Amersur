<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Servicio;

class ServicioRepo extends BaseRepo{

    public function getModel()
    {
        return new Servicio;
    }
}