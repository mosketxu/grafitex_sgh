<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignCarteleria extends Model
{
    protected $fillable=['campaign_id','carteleria_id','carteleria'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
