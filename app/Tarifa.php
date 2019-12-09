<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    const MATERIAL = 1;
    const PICKING = 2;
    const TRANSPORTE = 3;

    protected $fillable=['familia','tipo','tramo1','tarifa1','tramo2','tarifa2','tramo3','tarifa3'];

    public function tarifafamilias()
    {
        return $this->hasMany(TarifaFamilia::class);
    }

    public function campaignelementos()
    {
        return $this->hasMany(CampaignElemento::class);
    }

    public function campaignpresupuestodetalles()
    {
        return $this->hasMany(CampaignPresupuestoDetalle::class);
    }

    public function campaignresumenelemento()
    {
        return $this->hasMany(VCampaignResumenElemento::class);
    } 

    public function scopeSearch($query, $busca)
    {
      return $query->where('familia', 'LIKE', "%$busca%")
      ->orWhere('tramo1', 'LIKE', "%$busca%")
      ->orWhere('tarifa1', 'LIKE', "%$busca%")
      ;
    }

 
}


