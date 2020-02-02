<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignStore extends Model
{
    protected $fillable=['campaign_id','store_id','store'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    static function getStore($campaignId,$store)
    {
        return CampaignStore::where('campaign_id',$campaignId)
            ->where('store_id',$store)
            ->first();

    }

}