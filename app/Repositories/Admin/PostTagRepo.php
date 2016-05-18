<?php namespace Amersur\Repositories\Admin;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\PostTag;

class PostTagRepo extends BaseRepo {

    public function getModel()
    {
        return new PostTag;
    }
}