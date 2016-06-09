<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\AgendaContacto;
use Illuminate\Http\Request;

class AgendaContactoRepo extends BaseRepo{

    public function getModel()
    {
        return new AgendaContacto();
    }

    //BUSQUEDA DE REGISTROS
    public function paginateAgenda(Request $request)
    {
        return $this->getModel()
                    ->orderBy('nombres', 'asc')
                    ->paginate();
    }

}