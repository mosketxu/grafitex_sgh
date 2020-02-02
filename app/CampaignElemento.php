<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CampaignElemento extends Model
{
    public $timestamps = true;
    
    protected $fillable=['campaign_id','tienda_id', 'store_id','country','idioma','name','area','segmento','storeconcept','ubicacion','mobiliario',
        'propxlemento','carteleria','medida','material','unitxprop','imagen','observaciones','precio','validado','motivo','otros','updated_by'
    ];


    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class,'familia');
    }    

    public function scopeSearch($query, $busca)
    {
      return $query->where('campaign_elementos.store_id', 'LIKE', "%$busca%")
      ->orWhere('name', 'LIKE', "%$busca%")
      ->orWhere('country', 'LIKE', "%$busca%")
      ->orWhere('idioma', 'LIKE', "%$busca%")
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

    public function scopeTienda($query, $campaignid)
    {
      return $query->join('campaign_tiendas','campaign_tiendas.id','tienda_id')
      ->where('campaign_id',$campaignid)
      ;
    }

    public function scopeOK($query, $busca)
    {
      if($busca=='OK')
        return $query->where('estadorecepcion', '1');
      elseif($busca=='KO')
        return $query->where('estadorecepcion','>', '1');
      elseif($busca=='nv')
        return $query->where('estadorecepcion', '0');
    }


    static function asignElementosPrecio($campaignId)
    {
        $elementos=CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id') 
        ->select('campaign_elementos.id as id','precio','familia')
        ->where('campaign_id',$campaignId)
        ->get();

        foreach ($elementos as $elemento){
            $conteo=CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
            ->where('campaign_id',$campaignId)
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

        return CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->select(DB::raw('SUM(unitxprop*precio) as total'))
        ->first();
    }
}
