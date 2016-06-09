<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Inmueble;

class InmuebleRepo extends BaseRepo{

    public function getModel()
    {
        return new Inmueble;
    }

    //BUSQUEDAS DE REGISTROS ELIMINADOS
    public function findAndPaginateDeletes(Request $request)
    {
        return $this->getModel()
                    ->onlyTrashed()
                    ->titulo($request->get('titulo'))
                    ->orderBy('deleted_at', 'desc')
                    ->paginate();
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

    //MOSTRAR PRODUCTOS DE CATEGORIA
    public function findProductsCategory($category, $paginate)
    {
        return $this->getModel()
                    ->where('category_id', $category)
                    ->orderBy('titulo', 'asc')
                    ->paginate($paginate);
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