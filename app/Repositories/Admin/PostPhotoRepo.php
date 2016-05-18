<?php namespace Amersur\Repositories\Admin;

use Amersur\Entities\PostPhoto;
use Amersur\Repositories\BaseRepo;

class PostPhotoRepo extends BaseRepo{

    public function getModel()
    {
        return new PostPhoto;
    }
}