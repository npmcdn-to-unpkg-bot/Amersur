<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class ProductImage extends BaseEntity{

    protected $fillable = ['product_id','imagen','imagen_carpeta','orden'];

    public function product()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Product', 'product_id');
    }

}