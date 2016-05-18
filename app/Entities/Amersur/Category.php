<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class Category extends BaseEntity {

	protected $fillable = ['titulo','slug_url','publicar'];

	public function product()
    {
        return $this->hasMany('Amersur\Entities\Amersur\Product');
    }

    public function provider()
    {
        return $this->hasMany('Amersur\Entities\Amersur\Provider');
    }

    public function productCount()
    {
        return $this->hasMany('Amersur\Entities\Amersur\Product')->where('publicar','1')->count();
    }

}