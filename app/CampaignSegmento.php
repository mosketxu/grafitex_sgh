<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignSegmento extends Model
{
    protected $fillable=['campaign_id','segmento_id','segmento'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
