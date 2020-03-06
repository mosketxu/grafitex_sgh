<?php

namespace App\Http\Controllers;

use App\{Campaign, CampaignElemento, 
        CampaignPresupuesto, CampaignPresupuestoDetalle, CampaignPresupuestoExtra,
        CampaignPresupuestoPickingtransporte, Elemento, Tarifa, TarifaFamilia,
        VCampaignPromedio, VCampaignResumenElemento};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignPresupuestoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request, $campaignId)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 
        $campaign = Campaign::find($campaignId);

        $presupuestos= CampaignPresupuesto::search($request->busca)
            ->where('campaign_id',$campaignId)
            ->orderBy('fecha')
            ->paginate('50');
        
        return view('campaign.presupuesto.index', compact('presupuestos','campaign','busqueda'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required',
            'version' => 'required',
            'fecha' => 'required|date',
            'estado' => 'required',
            ]);

        // recupero la lista de elementos creada y asigno el precio en función de cuántos hay
        // calculo el total actual de los elementos para insertarlo y mostrarlo en el indice de prepuestos
        // Lo hago cada vez que genero un presupuesto para tener siempre el último precio

        //cambio el 5/3/2020 Como solo se va a usar un tramo, asigno el precio del tramo 1.

        $totalpresupuestoMat= CampaignElemento::asignElementosPrecio($request->campaign_id);

        $campPresu=CampaignPresupuesto::create($request->all());
        // $campPresu->total=$totalpresupuestoMat->total;
        $campPresu->total=$totalpresupuestoMat;
        $campPresu->save();

        // guardo los materiales en campaign_presupuestos_detalle para tener historico si se cambian los precios en una segunda versión del presupuesto
        $materiales=VCampaignResumenElemento::where('campaign_id',$request->campaign_id)
        ->get();
        if($materiales->count()>0){
            foreach (array_chunk($materiales->toArray(),1000) as $t){
                $dataSet = [];
                foreach ($t as $material) {
                    $dataSet[] = [
                        'presupuesto_id'  => $campPresu->id,
                        'familia'  => $material['familia'],
                        'precio'  => $material['precio'],
                        'unidades'  => $material['unidades'],
                        'total'  => $material['tot'],
                    ];
                }
                DB::table('campaign_presupuesto_detalles')->insert($dataSet); 
            }
        }

        // guardo picking y transporte en campaign_presupuestos_pickintransporte para tener historico si se cambian los precios en una segunda versión del presupuesto        
        $stores=VCampaignPromedio::where('campaign_id',$request->campaign_id)
        ->select('zona',DB::raw('count(store_id) as tiendas'),DB::raw('SUM(tot) as total'))
        ->groupBy('zona')
        ->get()
        ->toArray();

        $totalStores=VCampaignPromedio::where('campaign_id',$request->campaign_id) 
        ->count();
        $dataSet=[];
        foreach($stores as $store){
            
            $pick=Tarifa::where('tipo',1)
                ->where('zona',$store['zona'])
                ->first();
            $transp=Tarifa::where('tipo',2)
                ->where('zona',$store['zona'])
                ->first();

            $dataSet[]=[
                'presupuesto_id'=>$campPresu->id,
                'zona'=>$store['zona'],
                'picking'=>$pick['tarifa1'],
                'transporte'=>$transp['tarifa1'],
                'stores'=>$store['tiendas'],
                'totalstores'=>$totalStores,
                'totalzona'=>$store['total'],
                'total'=>$totalpresupuestoMat
                // 'total'=>$totalpresupuestoMat->total
            ];
        }
        DB::table('campaign_presupuesto_pickingtransportes')->insert($dataSet);


        $notification = array(
            'message' => '¡Presupuesto creado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaignpresupuesto=CampaignPresupuesto::find($id); 
        $campaign=Campaign::find($campaignpresupuesto->campaign_id);
        $materiales=CampaignPresupuestoDetalle::where('presupuesto_id',$campaignpresupuesto->id)->get();
        
        return view('campaign.presupuesto.edit',compact('campaign','materiales','campaignpresupuesto'));
    }

    public function cotizacion($id)
    {
        $campaignpresupuesto=CampaignPresupuesto::find($id);
        $campaign=Campaign::find($campaignpresupuesto->campaign_id);
        
        // Info de promedios
        $promedios=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$id)
        ->get();

        $totalStores=VCampaignPromedio::where('campaign_id',$campaignpresupuesto->campaign_id)
        ->count();
        
        // Info de materiales
        $totalMateriales=CampaignPresupuestoDetalle::where('presupuesto_id',$id)
        ->sum('total');
        
        $materiales=VCampaignResumenElemento::where('campaign_id',$campaignpresupuesto->campaign_id)
        ->get();

        $extras=CampaignPresupuestoExtra::where('presupuesto_id',$campaignpresupuesto->id)
        ->get(); 

        $totalExtras = CampaignPresupuestoExtra::where('presupuesto_id',$campaignpresupuesto->id)
        ->sum('total');

        return view('campaign.presupuesto.cotizacion',
            compact(
                'campaign','campaignpresupuesto',
                'promedios','totalMateriales','totalStores',
                'materiales',
                'extras','totalExtras'
                ));
    }

    public function elementosfamilia($campaignId,$familiaId,$presupuesto)
    {
        $elementos=CampaignElemento::join('campaign_tiendas','campaign_elementos.tienda_id','campaign_tiendas.id')
        ->where('campaign_id',$campaignId)
        ->where('familia',$familiaId)
        ->get();

        $tarifas=Tarifa::where('tipo','0')
        ->get();
        $campaign=Campaign::find($campaignId);

        return view('campaign.presupuesto.elementos',compact('campaign','elementos','presupuesto','tarifas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'referencia' => 'required',
            'version' => 'required',
            // 'fecha' => 'required|date',
            'estado' => 'required',
            ]);
            
        CampaignPresupuesto::find($id)->update($request->all());
        $campaign=Campaign::find($request->campaign_id);
                
        $notification = array(
            'message' => '¡Presupuesto actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );
                
        return redirect()->back()->with($notification);
    }

    public function updateelemento(Request $request)
    {
        
        $campaignelem=CampaignElemento::where('elemento_id',$request->elemento_id)
        ->update(['familia'=>$request->familia]);

        $campaignelem=CampaignElemento::where('elemento_id',$request->elemento_id)->first();

        Elemento::where('material',$campaignelem->material)
        ->where('medida',$campaignelem->medida)
        ->update(['familia_id'=>$request->familia]);

        // $t=TarifaFamilia::where('material',$campaignelem->material)
        // ->where('medida',$campaignelem->medida)
        // ->get();

        TarifaFamilia::where('material',$campaignelem->material)
        ->where('medida',$campaignelem->medida)
        ->update(['tarifa_id'=>$request->familia]);

        // $t=TarifaFamilia::where('material',$campaignelem->material)
        // ->where('medida',$campaignelem->medida)
        // ->first();
        

        $notification = array(
            'message' => 'Tarifa actualizada satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function refresh($campaignId,$presupuestoId)
    {
        // elimino los detalles del presupuesto y de picking y trasnporte para poner nuevos precios
        $detallePresup=CampaignPresupuestoDetalle::where('presupuesto_id',$presupuestoId)->count();
        if ($detallePresup>0)
            CampaignPresupuestoDetalle::where('presupuesto_id',$presupuestoId)->delete();

        $pickingtransp=CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuestoId)->count();
        if ($pickingtransp>0)
            CampaignPresupuestoPickingtransporte::where('presupuesto_id',$presupuestoId)->delete();

        //actualizo los valores de la familia en los elementos de la campaña

        $elementos=CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','campaign_elementos.tienda_id')
            // ->select('campaign_tiendas.campaign_id','campaign_elementos.id as elemId','material','medida')
            ->where('campaign_id',$campaignId)
            ->get();

        foreach ($elementos as $elemento){
            $familia=TarifaFamilia::getFamilia($elemento['material'],$elemento['medida']);
            $fam=$familia['id'];

            if (is_null($fam))
                $fam=1;

                CampaignElemento::where('elemento_id',$elemento->elemento_id)
            ->update([
                'familia'=>$fam
            ]);
        }
        
        $totalpresupuestoMat= CampaignElemento::asignElementosPrecio($campaignId);
            
        // guardo los materiales en campaign_presupuestos_detalle para tener historico si se cambian los precios en una segunda versión del presupuesto
        $materiales=VCampaignResumenElemento::where('campaign_id',$campaignId)
        ->get();

        if($materiales->count()>0){
            foreach (array_chunk($materiales->toArray(),500) as $t){
                $dataSet = [];
                foreach ($t as $material) {
                    $dataSet[] = [
                        'presupuesto_id'  => $presupuestoId,
                        'familia'  => $material['familia'],
                        'precio'  => $material['precio'],
                        'unidades'  => $material['unidades'],
                        'total'  => $material['tot'],
                    ];
                }
                DB::table('campaign_presupuesto_detalles')->insert($dataSet);
            }
        }

        // guardo picking y transporte en campaign_presupuestos_pickintransporte para tener historico si se cambian los precios en una segunda versión del presupuesto        
        $stores=VCampaignPromedio::where('campaign_id',$campaignId)
        ->select('zona',DB::raw('count(store_id) as tiendas'),DB::raw('SUM(tot) as total'))
        ->groupBy('zona')
        ->get()
        ->toArray();
        
        $totalStores=VCampaignPromedio::where('campaign_id',$campaignId)
        ->count();
        $dataSet=[];

        foreach($stores as $store){
            // dd($store);
            $pick=Tarifa::where('tipo',1)
                ->where('zona',$store['zona'])
                ->first();
            $transp=Tarifa::where('tipo',2)
                ->where('zona',$store['zona'])
                ->first();

            $dataSet[]=[
                'presupuesto_id'=>$presupuestoId,
                'zona'=>$store['zona'],
                'picking'=>$pick->tarifa1,
                'transporte'=>$transp->tarifa1,
                'stores'=>$store['tiendas'],
                'totalstores'=>$totalStores,
                'totalzona'=>$store['total'],
                'total'=>$totalpresupuestoMat
                // 'total'=>$totalpresupuestoMat->total
            ];
            // print_r($dataSet);die();
        }

        DB::table('campaign_presupuesto_pickingtransportes')->insert($dataSet);

        $notification = array(
            'message' => '¡Nuevos precios asociados satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CampaignPresupuesto::find($id)->delete();

        return response()->json(['success'=>'Eliminado con exito']);
    }
}
