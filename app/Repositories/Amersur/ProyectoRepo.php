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
                    ->orderBy('published_at','desc')
                    ->paginate();
    }

    //PROYECTOS EN FRONTEND
    public function frontPaginateProyectos()
    {
        return $this->getModel()
                    ->orderBy('published_at','desc')
                    ->where('publicar','1')
                    ->where('published_at','<',$this->fechaActual())
                    ->paginate(9);
    }

}