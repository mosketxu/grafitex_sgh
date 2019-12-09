<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCampaignPromedio extends Model
{
    protected $table = "v_campaign_promedios"; 

    public function campaign(){
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
