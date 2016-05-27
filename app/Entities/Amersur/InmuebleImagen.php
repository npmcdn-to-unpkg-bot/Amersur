<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class InmuebleImagen extends BaseEntity{

    protected $fillable = ['product_id','imagen','imagen_carpeta','orden'];

    protected $table = 'inmueble_imagenes';

    public function product()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Product', 'product_id');
    }

}