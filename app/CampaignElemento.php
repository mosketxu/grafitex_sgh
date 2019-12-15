<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CampaignElemento extends Model
{
    public $timestamps = true;
    
    protected $with=['campatiendas'];

    protected $fillable=['campaign_id','tienda_id', 'store_id','country','name','area','segmento','storeconcept','ubicacion','mobiliario',
        'propxlemento','carteleria','medida','material','unitxprop','imagen','observaciones','precio'
    ];

   
    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id'); //no hace falta porque ya busca este campo, pero asi me acuerdo como es
    }

    // public function campaignstore()
    // {
    //     return $this->belongsTo(CampaignStore::class,'store_id');
    // }

    public function campatiendas()
    {
        return $this->belongsTo(CampaignTienda::class);
    }

    // public function tienda()
    // {
    //     return $this->belongsTo(Store::class,'store_id');
    // }

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class,'familia');
    }    

    public function scopeSearch($query, $busca)
    {
      return $query->where('store_id', 'LIKE', "%$busca%")
      ->orWhere('name', 'LIKE', "%$busca%")
      ->orWhere('country', 'LIKE', "%$busca%")
      ->orWhere('area', 'LIKE', "%$busca%")
      ->orWhere('segmento', 'LIKE', "%$busca%")
      ->orWhere('storeconcept', 'LIKE', "%$busca%")
      ->orWhere('ubicacion', 'LIKE', "%$busca%")
      ->orWhere('mobiliario', 'LIKE', "%$busca%")
      ->orWhere('propxelemento', 'LIKE', "%$busca%")
      ->orWhere('carteleria', 'LIKE', "%$busca%")
      ->orWhere('medida', 'LIKE', "%$busca%")
      ->orWhere('material', 'LIKE', "%$busca%")
      ->orWhere('observaciones', 'LIKE', "%$busca%") 
      ;
    }

    static function asignElementosPrecio($campaignId)
    {

        $elementos=CampaignElemento::where('campaign_id',$campaignId)
        ->get();
    
    
        foreach ($elementos as $elemento){
            $conteo=CampaignElemento::where('campaign_id',$campaignId)
                ->where('familia',$elemento->familia)
                ->count();

            $fam=Tarifa::where('id',$elemento->familia)->first();
                
            if($conteo<$fam->tramo2)
                $elemento->precio=$fam->tarifa1;
            elseif($conteo>$fam->tramo3)
                $elemento->precio=$fam->tarifa3;
            else
                $elemento->precio=$fam->tarifa2;
            
            $elemento->save();
        }

        return CampaignElemento::where('campaign_id',$campaignId)
            ->select(DB::raw('SUM(unitxprop*precio) as total'))
            ->first();
    }

}
