<?php namespace Amersur\Repositories\Admin;

use Auth;
use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\History;

class HistoryRepo extends BaseRepo{

    public function getModel()
    {
        return new History;
    }

    //GUARDAR HISTORIAL
    public function saveHistory($entity, $table, $id, Request $request, $type)
    {
        $contenido = json_encode($request->except('_method','_token'));

        $entity->tabla = $table;
        $entity->tabla_id = $id;
        $entity->user_id = Auth::user()->profile->id;
        $entity->type = $type;
        $entity->descripcion = $contenido;
        return $entity->save();
    }

    //BUSCAR HISTORIAL
    public function findHistory($tabla, $tabla_id)
    {
        return $this->getModel()->where('tabla', $tabla)
                                ->where('tabla_id', $tabla_id)
                                ->orderBy('created_at','desc')
                                ->paginate();
    }

    //BUSCAR HISTORIAL ESTADO
    public function findHistoryOrderAsc($tabla, $tabla_id)
    {
        return $this->getModel()->where('tabla', $tabla)
                                ->where('tabla_id', $tabla_id)
                                ->orderBy('created_at','asc')
                                ->paginate();
    }

}