<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\InmuebleImagen;

class InmuebleImagenRepo extends BaseRepo{

    public function getModel()
    {
        return new InmuebleImagen;
    }

}