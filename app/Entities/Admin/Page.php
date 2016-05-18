<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

class Page extends BaseEntity {

	protected $fillable = ['titulo','contenido','user_id'];

	public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }
    
}