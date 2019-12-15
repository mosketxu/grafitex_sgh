<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignStore extends Model
{
    protected $fillable=['campaign_id','store_id','store'];

    // protected $with=['campaignelementos'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // public function tienda() 
    // {
    //     return $this->belongsTo(Store::class,'store_id');
    // }

    // public function campaignelementos()
    // {
    //     return $this->hasMany(CampaignElemento::class);
    // }

    static function getStore($campaignId,$store)
    {
        return CampaignStore::where('campaign_id',$campaignId)
            ->where('store_id',$store)
            ->first();

    }

}