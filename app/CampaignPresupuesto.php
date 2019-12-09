<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class CampaignPresupuesto extends Model
{
    use SoftDeletes;

    protected $fillable=['campaign_id','referencia','fecha','version','atencion','total','observaciones','estado'];

    protected $dates = ['fecha'];

    public function scopeSearch($query, $busca)
    {
        return $query->where('referencia', 'LIKE', "%$busca%")
            ->orWhere('fecha', 'LIKE', "%$busca%")
            ->orWhere('atencion', 'LIKE', "%$busca%")
            ->orWhere('observaciones', 'LIKE', "%$busca%")
            ->orWhere('estado', 'LIKE', "%$busca%")
            ;
    }
  

    public function campaign(){
    return $this->belongsTo(Campaign::class);
    }

    public function extras(){
        return $this->hasMany(CampaignPresupuestoExtra::class);
    }

}
