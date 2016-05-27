<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Inmueble;

class InmuebleRepo extends BaseRepo{

    public function getModel()
    {
        return new Inmueble;
    }

    //GRAFICO AVANCE
    public function graficoAvance()
    {
        return $this->getModel()
                    ->select([\DB::raw('DATE_FORMAT(created_at,"%d/%m/%Y") fecha, UNIX_TIMESTAMP(created_at) created, COUNT(*) avance')])
                    ->orderBy('created_at', 'asc')
                    ->groupBy('fecha')
                    ->havingRaw('COUNT(*)')
                    ->get();
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
                    ->category($request->get('category'))
                    ->destacado($request->get('destacado'))
                    ->oferta($request->get('oferta'))
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

    //MOSTRAR OFERTAS
    public function orderOferPag($field, $order, $value)
    {
        return $this->getModel()
                    ->where('oferta', 1)
                    ->where('publicar', 1)
                    ->orderBy($field, $order)
                    ->paginate($value);
    }

    //MOSTRAR DESTACADOS
    public function orderDestPag($field, $order, $value)
    {
        return $this->getModel()
                    ->where('destacado', 1)
                    ->where('publicar', 1)
                    ->orderBy($field, $order)
                    ->paginate($value);
    }

    //FILTRO PRODUCTOS
    public function filterProduct($category, Request $request)
    {
        return $this->getModel()
                    ->where('category_id', $category)
                    ->brand($request->get('brand'))
                    ->paginate(16);
    }

    //BUSCAR
    public function buscar(Request $request)
    {
        $q = $request->input('pr');

        return $this->getModel()
                    ->whereRaw("MATCH(titulo,descripcion) AGAINST(?)",array($q))
                    ->paginate(24);
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