<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

class PostTag extends BaseEntity{

    protected $fillable = ['titulo','slug_url','publicar'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

} 