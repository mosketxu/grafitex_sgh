<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignTienda extends Model
{
    protected $fillable=['campaign_id','store_id'];

    protected $with=['campaign','tienda'];

    public function campaign() 
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }

    public function tienda() 
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function elementos() 
    {
        return $this->hasMany(CampaignElemento::class,'tienda_id');
    }
    public function scopeStore($query, $campaignid)
    {
      return $query->join('stores','store.id','store_id')
      ->where('campaign_id',$campaignid)
      ;
    }

    public function scopeStoreElemento($query, $campaignid)
    {
      return $query->join('stores','stores.id','store_id')
      ->join('campaign_elementos','campaign_tiendas.id','tienda_id')
      ->where('campaign_id',$campaignid)
      ;
    }

}
