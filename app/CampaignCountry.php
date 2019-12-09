<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignCountry extends Model
{
    protected $fillable=['campaign_id','country_id','country'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
