<?php namespace Amersur\Repositories\Admin;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\PostCategory;

class PostCategoryRepo extends BaseRepo {

    public function getModel()
    {
        return new PostCategory;
    }
}