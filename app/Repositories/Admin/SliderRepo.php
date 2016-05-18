<?php namespace Amersur\Repositories\Admin;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Admin\Slider;

class SliderRepo extends BaseRepo{

    public function getModel()
    {
        return new Slider;
    }

}