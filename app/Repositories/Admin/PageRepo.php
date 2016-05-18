<?php namespace Amersur\Repositories\Admin;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Page;

class PageRepo extends BaseRepo{

    public function getModel()
    {
        return new Page;
    }

}