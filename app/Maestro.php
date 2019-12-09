<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\{Ubicacion,Carteleria,Material,Medida, Mobiliario,Propxelemento,Area,Storeconcept};

class Maestro extends Model
{
    use SoftDeletes;

    protected $fillable=['store','country','name','area','segmento','storeconcept','elementificador','ubicacion','mobiliario','propxelemento','carteleria','medida','material','unitxprop','observaciones'];

    // protected $guarded = [];

    static function scopeCampaignStore($query, $campaign)
    {
        return $query
        ->whereIn('store', function ($query) use ($campaign) {
            $query->select('store_id')->from('campaign_stores')->where('campaign_id', '=', $campaign);})
        ->whereIn('segmento', function ($query) use ($campaign) {
            $query->select('segmento')->from('campaign_segmentos')->where('campaign_id', '=', $campaign);})
        ->whereIn('ubicacion', function ($query) use ($campaign) {
            $query->select('ubicacion')->from('campaign_ubicacions')->where('campaign_id', '=', $campaign);})
        ->whereIn('mobiliario', function ($query) use ($campaign) {
            $query->select('mobiliario')->from('campaign_mobiliarios')->where('campaign_id', '=', $campaign);})
        ->whereIn('medida', function ($query) use ($campaign) {
            $query->select('medida')->from('campaign_medidas')->where('campaign_id', '=', $campaign);})
        ->select('maestros.store','maestros.country','maestros.name','maestros.area','maestros.segmento','maestros.storeconcept',
            'maestros.ubicacion','maestros.mobiliario','maestros.propxelemento','maestros.carteleria','maestros.medida','maestros.material',
            'maestros.unitxprop','maestros.observaciones', DB::raw($campaign.' as campaign_id'));
    }

    static function insertStores()
    {
        $stores=Maestro::select('store','name','country','area','segmento','storeconcept')
        ->groupBy('store','name','country','area','segmento','storeconcept')
        ->get();

        foreach (array_chunk($stores->toArray(),100) as $t){
            $dataSet = [];
            foreach ($t as $store) {
                if ($store['country']=='PT'){
                    $zona='PT';
                }
                else{
                    if($store['area']=='Canarias')
                        $zona='CA';
                    else
                        $zona='ES';
                }
                $conceptoId=Storeconcept::where('storeconcept',$store['storeconcept'])->first();
                $areaId=Area::where('area',$store['area'])->first();
                $dataSet[] = [
                    'id'  => $store['store'],
                    'name'=>$store['name'],
                    'country'=>$store['country'],
                    'zona'=>$zona,
                    'area_id'=>$areaId->id,
                    'area'=>$store['area'],
                    'segmento'=>$store['segmento'],
                    'concepto_id'=>$conceptoId->id,
                    'concepto'=>$store['storeconcept']
                ];
            }
            DB::table('stores')->insert($dataSet);
        }
        return true;
    }

    static function insertElementos()
    {
        $elementos=Maestro::select(
            'elementificador','ubicacion','mobiliario',
            'propxelemento','carteleria','medida','material',
            'unitxprop','observaciones')
            ->distinct('elementificador')
            ->get();

        foreach (array_chunk($elementos->toArray(),100) as $t){
            $dataSet = [];
            foreach ($t as $elemento) {
                $dataSet[] = [
                    'elementificador'=>$elemento['elementificador'],
                    'ubicacion_id'=>Ubicacion::where('ubicacion',$elemento['ubicacion'])->first()['id'],
                    'ubicacion'=>$elemento['ubicacion'],
                    'mobiliario_id'=>Mobiliario::where('mobiliario',$elemento['mobiliario'])->first()['id'],
                    'mobiliario'=>$elemento['mobiliario'],
                    'propxelemento_id'=>Propxelemento::where('propxelemento',$elemento['propxelemento'])->first()['id'],
                    'propxelemento'=>$elemento['propxelemento'],
                    'carteleria_id'=>Carteleria::where('carteleria',$elemento['carteleria'])->first()['id'],
                    'carteleria'=>$elemento['carteleria'],
                    'medida_id'=>Medida::where('medida',$elemento['medida'])->first()['id'],
                    'medida'=>$elemento['medida'],
                    'material_id'=>Material::where('material',$elemento['material'])->first()['id'],
                    'material'=>$elemento['material'],
                    'unitxprop'=>$elemento['unitxprop'],
                    'observaciones'=>$elemento['observaciones'],
                ];
            }
            DB::table('elementos')->insert($dataSet);
        }
        return true;
    }

    static function insertStoreElementos()
    {
        $storeElementos=Maestro::select('store','elementificador')
            ->groupBy('store','elementificador')
            ->get();
        $cont=0;
        foreach (array_chunk($storeElementos->toArray(),50) as $t){
            $dataSet = [];
            foreach ($t as $elemento) {
                $dataSet[] = [
                    'store_id'=>$elemento['store'],
                    'elemento_id'=>Elemento::where('elementificador',$elemento['elementificador'])->first()['id'],
                    'elementificador'=>$elemento['elementificador'],
                ];
                // $cont++;
                // if($cont>3750)
                // dd($cont);
            }
            DB::table('store_elementos')->insert($dataSet);
        }
        return true;
    }
}
