<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class ProyectoImagen extends BaseEntity{

    protected $fillable = ['proyecto_id','imagen','imagen_carpeta','orden'];

    protected $table = 'proyecto_imagenes';

}