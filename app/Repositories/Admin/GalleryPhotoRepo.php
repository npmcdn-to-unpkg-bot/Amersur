<?php namespace Amersur\Repositories\Admin;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\GalleryPhoto;

class GalleryPhotoRepo extends BaseRepo {

    public function getModel()
    {
        return new GalleryPhoto;
    }
}