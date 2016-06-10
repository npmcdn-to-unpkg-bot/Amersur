<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\ProyectoImagen;

class ProyectoImagenRepo extends BaseRepo{

    public function getModel()
    {
        return new ProyectoImagen();
    }

}