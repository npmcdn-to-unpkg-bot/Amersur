<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Proyecto;
use Illuminate\Http\Request;

class ProyectoRepo extends BaseRepo{

    public function getModel()
    {
        return new Proyecto();
    }

    //BUSQUEDA DE REGISTROS
    public function paginateProyectos(Request $request)
    {
        return $this->getModel()
                    ->orderBy('titulo', 'asc')
                    ->paginate();
    }

}