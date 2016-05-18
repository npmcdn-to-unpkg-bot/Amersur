<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Category;

class CategoryRepo extends BaseRepo {

    public function getModel()
    {
        return new Category;
    }
}