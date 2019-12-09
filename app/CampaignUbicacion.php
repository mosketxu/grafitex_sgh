<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignUbicacion extends Model
{
    protected $fillable=['campaign_id','ubicacion_id','ubicacion'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
