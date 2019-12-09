<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignMobiliario extends Model
{
    protected $fillable=['campaign_id','mobiliario_id','mobiliario'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
