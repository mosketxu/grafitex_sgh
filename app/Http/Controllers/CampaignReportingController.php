<?php

namespace App\Http\Controllers;

use App\{Campaign, CampaignElemento, Store, CampaignPresupuesto,CampaignPresupuestoDetalle,CampaignPresupuestoExtra,VCampaignResumenElemento,VCampaignPromedio,CampaignPresupuestoPickingtransporte, CampaignTienda};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class CampaignReportingController extends Controller
{
    public function index($campaignId)
    {
        $today=Carbon::now()->format('d/m/Y');
        
        $etiquetas=Campaign::where('id',$campaignId)
        ->first(); 

        return view('reporting.etiquetasHTML',compact('etiquetas','today'));
        // return view('reporting.etiquetasHTMLBootstrap',compact('etiquetas','today'));
    }

    public function pdf($campaignId){

        $today=Carbon::now()->format('d/m/Y');
        
        $etiquetas=Campaign::where('id',$campaignId)
        ->first();


        $pdf = \PDF::loadView('reporting.etiquetasHTML',compact('etiquetas','today'));
        // $pdf->setPaper('a4','landscape');
        $pdf->setPaper('a4','portrait');

        return $pdf->download('etiquetas.pdf'); //así lo descarga
        // return $pdf->stream(); // así lo muestra en pantalla
   }

   public function pdfPresupuesto($presupuestoId){
    $today=Carbon::now()->format('d/m/Y');
    
    $presupuesto=CampaignPresupuesto::where('id',$presupuestoId)
    ->with('campaign')
    ->first();

    $promedios=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuestoId)
    ->get();

    $totalPickingEs=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuestoId)
    ->where('zona','ES')
    ->orWhere('zona','CA')
    ->select(DB::raw('SUM(picking * stores) as picking'),DB::raw('SUM(transporte * stores) as transporte'))
    ->first();

    $totalPickingPt=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuestoId)
    ->where('zona','PT')
    ->select(DB::raw('SUM(picking * stores) as picking'),DB::raw('SUM(transporte * stores) as transporte'))
    ->first();

    $stores=CampaignTienda::join('stores','stores.id','store_id')
    ->select('zona')
    ->where('campaign_id',$presupuesto->campaign_id)
    ->get();

    $totalStores=$stores->count();

    $totalStoresEs=$stores->where('zona','ES')->count();
    $totalStoresCA=$stores->where('zona','CA')->count();
    $totalStoresEs=$totalStoresEs+$totalStoresCA;

    $totalStoresPt=$stores->where('zona','PT')
    ->count();

    // Info de materiales
    $totalMateriales=CampaignPresupuestoDetalle::where('presupuesto_id',$presupuesto->id)
    ->sum('total');

    $totalMaterialesEs=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuesto->id)
    ->where('zona','ES')
    ->orWhere('zona','CA')
    ->sum('totalzona');

    $totalMaterialesPt=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuesto->id)
    ->where('zona','PT')
    ->sum('totalzona');

    $materiales=VCampaignResumenElemento::where('campaign_id',$presupuesto->campaign_id)
    ->get();

    $extras=CampaignPresupuestoExtra::where('presupuesto_id',$presupuesto->id)
    ->get(); 

    $totalExtras = CampaignPresupuestoExtra::where('presupuesto_id',$presupuesto->id)
    ->sum('total');

    $totalExtrasEs=CampaignPresupuestoExtra::where('presupuesto_id',$presupuesto->id)
    ->where('zona','ES')
    ->orWhere('zona','CA')
    ->sum('total');

    $totalExtrasPt=CampaignPresupuestoExtra::where('presupuesto_id',$presupuesto->id)
    ->where('zona','PT')
    ->sum('total');    
    
    
    $pdf = \PDF::loadView('reporting.presupuesto',
        compact('presupuesto','promedios',
            'totalStores','totalMateriales',
            'materiales','extras','totalExtras',
            'totalMaterialesEs','totalMaterialesPt',
            'totalStoresEs','totalStoresPt',
            'totalPickingEs','totalPickingPt',
            'totalExtrasEs','totalExtrasPt',
            'today' ));

    // $pdf->setPaper('a4','landscape');
    $pdf->setPaper('a4','portrait');
    // return $pdf->download('etiquetas.pdf'); así lo descarga
    return $pdf->stream(); // así lo muestra en pantalla
}


}
