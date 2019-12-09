<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignMedida extends Model
{
    protected $fillable=['campaign_id','medida_id','medida'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
