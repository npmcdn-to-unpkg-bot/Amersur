<?php namespace Amersur\Entities;

class Role extends BaseEntity {

    public function user()
    {
        return $this->hasMany('Amersur\Entities\User', 'role_id', 'id');
    }

}