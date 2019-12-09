<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignStoreconcept extends Model
{
    protected $fillable=['campaign_id','storeconcept_id','storeconcept'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
