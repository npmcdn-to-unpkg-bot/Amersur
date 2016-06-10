<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class InmuebleImagen extends BaseEntity{

    protected $fillable = ['inmueble_id','imagen','imagen_carpeta','orden'];

    protected $table = 'inmueble_imagenes';

}