<?php namespace Amersur\Repositories\Admin;

use Amersur\Entities\Admin\Empresa;
use Amersur\Repositories\BaseRepo;

class EmpresaRepo extends BaseRepo{

    public function getModel()
    {
        return new Empresa();
    }

}