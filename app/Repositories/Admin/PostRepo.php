<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Post;

class PostRepo extends BaseRepo{

    public function getModel()
    {
        return new Post;
    }

    //BUSQUEDAS DE REGISTROS ELIMINADOS
    public function findAndPaginateDeletes(Request $request)
    {
        return $this->getModel()
                    ->onlyTrashed()
                    ->titulo($request->get('titulo'))
                    ->category($request->get('category'))
                    ->orderBy('deleted_at', 'desc')
                    ->paginate();
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->category($request->get('category'))
                    ->publicar($request->get('publicar'))
                    ->orderBy('published_at', 'desc')
                    ->paginate();
    }
}