<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable=['id','name','country','zona','area','segmento','concept','observaciones','imagen'];

    public function storeelementos()  
    {
        return $this->hasMany(StoreElemento::class);
    }

    public function campaignelementos()  
    {
        return $this->hasMany(CampaignElemento::class);
    }

    public function storeElement(){
        return $this->hasMany(StoreElemento::class);
    }

    public function scopeSearch($query, $busca)
    {
      return $query->where('id', 'LIKE', "%$busca%")
      ->orWhere('name', 'LIKE', "%$busca%")
      ->orWhere('country', 'LIKE', "%$busca%")
      ->orWhere('zona', 'LIKE', "%$busca%")
      ->orWhere('area', 'LIKE', "%$busca%")
      ->orWhere('segmento', 'LIKE', "%$busca%")
      ->orWhere('concept', 'LIKE', "%$busca%")
      ->orWhere('observaciones', 'LIKE', "%$busca%")
      ->orWhere('imagen', 'LIKE', "%$busca%")
      ;
    }

}
