<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Servicio;
use Illuminate\Http\Request;

class ServicioRepo extends BaseRepo{

    public function getModel()
    {
        return new Servicio();
    }

    //BUSQUEDA DE REGISTROS
    public function paginateServicios(Request $request)
    {
        return $this->getModel()
                    ->orderBy('published_at','desc')
                    ->paginate();
    }

    //PAGINAR SERVICIOS
    public function frontPaginateServicios()
    {
        return $this->getModel()->where('publicar',1)
                                ->orderBy('titulo','asc')
                                ->where('published_at','<',$this->fechaActual())
                                ->paginate();
    }

}