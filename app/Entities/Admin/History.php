<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

class History extends BaseEntity{

    protected $fillable = ['tabla','tabla_id','user_id','type','descripcion'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

}