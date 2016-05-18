<?php namespace Amersur\Entities\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Gallery extends BaseEntity{

	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','descripcion','contenido','imagen','published_at','publicar'];

} 