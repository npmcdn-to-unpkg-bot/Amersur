<?php namespace Amersur\Repositories;

use Amersur\Entities\UserProfile;

class UserProfileRepo extends BaseRepo{

    public function getModel()
    {
        return new UserProfile;
    }

}