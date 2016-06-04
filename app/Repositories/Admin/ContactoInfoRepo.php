<?php namespace Amersur\Repositories\Admin;

use Amersur\Entities\Admin\ContactoInfo;
use Amersur\Repositories\BaseRepo;

class ContactoInfoRepo extends BaseRepo{

    public function getModel()
    {
        return new ContactoInfo();
    }

}