<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignGaleria extends Model
{
    protected $fillable=['campaign_id','elemento','imagen','observaciones'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    public function getImagenUrlAttribute()
    {
        return $this->imagen ? 'storage/galeria/' . $this->imagen : 'pordefecto.jpg';
    }

    public function scopeSearch($query, $busca)
    {
      return $query->where('mobiliario', 'LIKE', "%$busca%")
      ->orWhere('carteleria', 'LIKE', "%$busca%")
      ->orWhere('medida', 'LIKE', "%$busca%")
      ->orWhere('eci', 'LIKE', "%$busca%")
      ->orWhere('observaciones', 'LIKE', "%$busca%")
      ;
    }
  
}
