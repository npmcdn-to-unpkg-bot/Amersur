<?php namespace Amersur\Entities;

class UserProfile extends BaseEntity {

	protected $fillable = ['nombres','apellidos','documento_tipo','documento_numero','direccion','telefonos','interses','pais_id','region_id','user_id'];

	public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

}