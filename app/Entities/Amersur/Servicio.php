<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Servicio extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['titulo','descripcion','contenido','publicar','imagen','imagen_carpeta','published_at'];


}