<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignArea extends Model
{
    protected $fillable=['campaign_id','area_id','area'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
