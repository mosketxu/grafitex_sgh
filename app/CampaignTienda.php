<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignTienda extends Model
{
    protected $fillable=['campaign_id','store_id'];

    protected $with=['campaign','tienda','cElementos'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }

    public function tienda() 
    {
        return $this->belongsTo(Store::class,'store_id');
    }


    public function cElementos()
    {
        return $this->hasMany(CampaignElemento::class,'tienda_id');
    }
}
