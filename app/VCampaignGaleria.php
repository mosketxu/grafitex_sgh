<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCampaignGaleria extends Model
{
    static function getGaleria($campaignId)
    {

        return VCampaignGaleria::where('campaign_id',$campaignId)
        ->select('campaign_id','mobiliario','carteleria','medida','ECI','elemento','imagen')
        ->groupBy('campaign_id','mobiliario','carteleria','medida','ECI','elemento','imagen')
        ->get();
    }

}
