<?php namespace Amersur\Repositories\Amersur;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\ProductImage;

class ProductImageRepo extends BaseRepo{

    public function getModel()
    {
        return new ProductImage;
    }

}