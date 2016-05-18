<?php namespace Amersur\Repositories\Admin;

use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Configuration;

class ConfigurationRepo extends BaseRepo{

    public function getModel()
    {
        return new Configuration;
    }

}