<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

class Configuration extends BaseEntity {

    protected $fillable = ['titulo','dominio','description','keywords','email'];

}