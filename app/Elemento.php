<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    public $timestamps = false;
    protected $table = "elementos"; 
    protected $fillable=[
        'elementificador',
        'ubicacion_id',
        'mobiliario_id',
        'propxelemento_id',
        'carteleria_id',
        'medida_id',
        'familia_id',
        'material_id',
        'unitxprop',
        'observaciones'
        ];

        protected $with=['ubica','mobi','propx','carte','medi','mater','famil'];

    public function scopeSearch($query, $busca)
        {
          return $query->where('ubicacion', 'LIKE', "%$busca%")
          ->orWhere('mobiliario', 'LIKE', "%$busca%")
          ->orWhere('carteleria', 'LIKE', "%$busca%")
          ->orWhere('medida', 'LIKE', "%$busca%")
          ->orWhere('material', 'LIKE', "%$busca%")
          ->orWhere('propxelemento', 'LIKE', "%$busca%")
          ->orWhere('observaciones', 'LIKE', "%$busca%")
          ->orWhere('id', 'LIKE', "%$busca%")
          ;
        }

        public function scopeUbi($query,$ubi)
        {
            if($ubi)
                return $query->where('ubicacion','LIKE',"%$ubi%");
        }
        public function scopeMob($query,$mob)
        {
            if($mob)
                return $query->where('mobiliario','LIKE',"%$mob%");
        }
        public function scopeCart($query,$cart)
        {
            if($cart)
                return $query->where('carteleria','LIKE',"%$cart%");
        }
        public function scopeMat($query,$mat)
        {
            if($mat)
                return $query->where('material','LIKE',"%$mat%");
        }
        public function scopeMed($query,$med)
        {
            if($med)
                return $query->where('medida','LIKE',"%$med%");
        }
        public function scopePropx($query,$propx)
        {
            if($propx)
                return $query->where('propxelemento','LIKE',"%$propx%");
        }

        public function scopeCampubi($query,$campaignId)
        {
            if (CampaignUbicacion::where('campaign_id',$campaignId)->count()>0){
                return $query->whereIn('ubicacion',function($q) use($campaignId){
                    $q->select('ubicacion')->from('campaign_ubicacions')->where('campaign_id',$campaignId);
                });}
        }
    
        public function scopeCampmob($query,$campaignId)
        {
            if (CampaignMobiliario::where('campaign_id',$campaignId)->count()>0){
                return $query->whereIn('mobiliario',function($q) use($campaignId){
                    $q->select('mobiliario')->from('campaign_mobiliarios')->where('campaign_id',$campaignId);
                });}
        }
    
        public function scopeCampmed($query,$campaignId)
        {
            if (CampaignMedida::where('campaign_id',$campaignId)->count()>0){
                return $query->whereIn('medida',function($q) use($campaignId){
                    $q->select('medida')->from('campaign_medidas')->where('campaign_id',$campaignId);
                });}
        }
    




    public function storeelementos()  
    {
        return $this->hasMany(StoreElemento::class,'elemento_id');
    }

    public function ubica()  
    {
        return $this->belongsTo(Ubicacion::class,'ubicacion_id');
    }
    
    public function mobi()  
    {
        return $this->belongsTo(Mobiliario::class,'mobiliario_id');
    }
    public function propx()  
    {
        return $this->belongsTo(Propxelemento::class,'propxelemento_id');
    }
    public function carte()  
    {
        return $this->belongsTo(Carteleria::class,'carteleria_id');
    }
    public function medi()  
    {
        return $this->belongsTo(Medida::class,'medida_id');
    }

    public function mater()  
    {
        return $this->belongsTo(Material::class,'material_id');
    }

    public function famil()  
    {
        return $this->belongsTo(Tarifa::class,'familia_id');
    }

}
