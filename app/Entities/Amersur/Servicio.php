<?php namespace Amersur\Entities\Amersur;

use Amersur\Entities\BaseEntity;

class Servicio extends BaseEntity {

    protected $fillable = ['titulo','provider_id','costo_tot_servicio','costo_por_kg','costo_serv_hra','peso_min','peso_max','money_id','pais_id','tiempo_min','tiempo_max','predeterminado','user_id','history'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Provider', 'provider_id');
    }

    public function money()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Money', 'money_id');
    }

    public function pais()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Pais', 'pais_id');
    }
	
}