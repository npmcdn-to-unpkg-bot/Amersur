<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

class PostPhoto extends BaseEntity {
    protected $fillable = ['titulo'];

    public function post()
    {
        return $this->belongsTo('Amersur\Entities\Post', 'post_id');
    }
} 