<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CampaignElemento extends Model
{
    public $timestamps = true;
    
    protected $fillable=['campaign_id','tienda_id', 'store_id','country','idioma','name','area','segmento','storeconcept','ubicacion','mobiliario',
        'propxlemento','carteleria','medida','material','familia','matmed','unitxprop','imagen','observaciones','precio','validado','motivo','otros','updated_by'
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

        $total=0;

        foreach ($elementos as $elemento){
            $fam=Tarifa::where('id',$elemento->familia)->first();
            $elemento->precio=$fam->tarifa1;
            $total=$total+$elemento->precio;
            $elemento->save();
        }
        return $total;
    }

    static function getGaleria($campaignId)
    {
        return CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','campaign_elementos.tienda_id')
        ->where('campaign_id',$campaignId)
        ->select('campaign_id','mobiliario','carteleria','medida','ECI','elemento','imagen')
        ->groupBy('campaign_id','mobiliario','carteleria','medida','ECI','elemento','imagen')
        ->get();
    }

    static function getElementos($campaignId)
    {
        return CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','campaign_elementos.tienda_id')
        ->where('campaign_id',$campaignId)
        ->select('campaign_id','familia','precio',DB::raw('SUM(unitxprop) as unidades'),DB::raw('SUM(unitxprop * precio) as tot'))
        ->groupBy('campaign_id','familia','precio')
        ->get();
    }

    static function getPromedios($campaignId)
    {
        return CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','campaign_elementos.tienda_id')
        ->where('campaign_id',$campaignId)
        ->select('campaign_id','zona','campaign_elementos.store_id as store_id',DB::raw('SUM(unitxprop * precio) as tot'))
        ->groupBy('campaign_id','zona','campaign_elementos.store_id')
        ->get();

    }


}


