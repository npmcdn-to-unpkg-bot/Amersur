<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Inmueble;

class InmuebleRepo extends BaseRepo{

    public function getModel()
    {
        return new Inmueble;
    }

    //INMUEBLES EN FRONTEND
    public function frontPaginateInmuebles()
    {
        return $this->getModel()
                    ->orderBy('published_at','desc')
                    ->where('publicar','1')
                    ->where('published_at','<',$this->fechaActual())
                    ->paginate(6);
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->bTipo($request->get('tipos'))
                    ->publicar($request->get('publicar'))
                    ->orderBy('created_at', 'desc')
                    ->paginate();
    }

    //BUSCAR PRODUCTO - ORDENAR - PAGINACION
    public function findOrderPaginate(Request $request, $field, $order, $paginate)
    {
        return $this->getModel()
                    ->titulo($request->get('pr'))
                    ->orderBy($field, $order)
                    ->paginate($paginate);
    }

    //BUSCAR
    public function buscar(Request $request)
    {
        return $this->getModel()
                    ->bTipo($request->input('t'))
                    ->bMoneda($request->input('m'))
                    ->bPrecioMax($request->input('p'))
                    ->orderBy('published_at','desc')
                    ->where('publicar','1')
                    ->where('published_at','<',$this->fechaActual())
                    ->paginate(10);
    }

    //BUSCAR JSON
    public function buscarJson(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->input('q'))
                    ->orderBy('titulo', 'asc')
                    ->get();
    }

}