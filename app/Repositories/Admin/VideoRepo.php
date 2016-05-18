<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Video;

class VideoRepo extends BaseRepo{

    public function getModel()
    {
        return new Video;
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
                    ->publicar($request->get('publicar'))
                    ->orderBy('published_at', 'desc')
                    ->paginate();
    }
}