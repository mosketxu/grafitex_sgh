<?php

namespace App\Http\Controllers;

use App\{Campaign,CampaignElemento, CampaignStore, CampaignTienda, Store};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TiendaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $storeId=(auth()->user()->name);
        $store=Store::find(auth()->user()->name);
        
        $campaigns=Campaign::search($request->busca)
            ->whereIn('id', function ($query) use ($storeId){
                $query->select('campaign_id')->from('campaign_stores')->where('store_id', '=', $storeId);
            })
            ->orderBy('campaign_initdate')
            ->paginate(10);
        return view('tienda.index',compact('campaigns','store','title','busqueda'));            
    }

    public function edit($camp,$sto, Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 
        $campaign = Campaign::find($camp);
        $store=Store::find($sto);

        $elementos= CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->where('campaign_id',$camp)
        ->where('campaign_elementos.store_id',$sto)
        ->select('campaign_elementos.id as id','estadorecepcion')
        ->get();
        // dd($elementos);

        $total=$elementos->count();
        $sinvalorar=$elementos->where('estadorecepcion','0')->count();
        $incidencias=$elementos->where('estadorecepcion','>','1')->count();
        $correctos=$elementos->where('estadorecepcion','1')->count();

        $elementos= CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->search($request->busca)
        ->where('campaign_id',$camp)
        ->where('campaign_elementos.store_id',$sto)
        ->select('campaign_elementos.id as id','campaign_elementos.store_id as store_id','ubicacion','mobiliario','propxelemento','carteleria','medida',
            'material','familia','unitxprop','imagen','observaciones','estadorecepcion','obsrecepcion')
        ->paginate(8);

        return view('tienda.edit', compact('campaign','store','elementos','busqueda','total','incidencias','correctos','sinvalorar'));    
    }

    public function show($camp,$sto,Request $request)
    {
        if ($request->busqueda) {
            $busqueda = $request->busqueda;
        } else {
            $busqueda = '';
        } 

        $campaign = Campaign::find($camp);
        $store=Store::find($sto);

        $elementos= CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->where('campaign_id',$camp)
        ->where('campaign_elementos.store_id',$sto)
        ->select('campaign_elementos.id as id','estadorecepcion')
        ->get();


        $total=$elementos->count();
        $sinvalorar=$elementos->where('estadorecepcion','0')->count();
        $incidencias=$elementos->where('estadorecepcion','>','1')->count();
        $correctos=$elementos->where('estadorecepcion','1')->count();

        $elementos= CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->OK($busqueda)
        ->where('campaign_id',$camp)
        ->select('campaign_elementos.id as id','campaign_elementos.store_id as store_id','ubicacion','mobiliario','propxelemento','carteleria','medida',
            'material','familia','unitxprop','imagen','observaciones','OK','KO','estadorecepcion','obsrecepcion')
        ->paginate(8);

        return view('tienda.show', compact('campaign','store','elementos','busqueda','total','incidencias','correctos','sinvalorar'));    
    }

    public function control(Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $campaigns=CampaignTienda::search($busqueda)
        ->with('campaign')
        ->with('tienda')
        ->join('campaign_elementos','campaign_tiendas.store_id','campaign_elementos.store_id')
        ->select('campaign_id','campaign_name',DB::raw('count(*) as total'),DB::raw('count(OK) as OK'),DB::raw('count(KO) as KO'))
        ->groupBy('campaign_id')
        ->paginate(10);
        
        return view('tienda.control',compact('campaigns','title','busqueda'));            
    }

    public function campaignstores($campaignId)
    {
        $campaign=Campaign::find($campaignId);
        $stores=CampaignTienda::with('campaign')->with('tienda')
        ->join('campaign_elementos','campaign_tiendas.store_id','campaign_elementos.store_id')
        ->select('campaign_id','campaign_tiendas.store_id',DB::raw('count(*) as total'),DB::raw('count(OK) as OK'),DB::raw('count(KO) as KO'))
        ->groupBy('campaign_id','campaign_tiendas.store_id')
        ->where('campaign_id',$campaignId)
        ->paginate(10);
        
        return view('tienda.campaignstores',compact('campaign','stores'));            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules=[
            'estadorecepcion'=>'required|integer|min:1',
        ];
        $messages = [
            'estadorecepcion.min' => 'Debes seleccionar una opción de Estado de recepción',
        ];
        $this->validate($request, $rules, $messages);

        CampaignStore::join('campaign_elementos','campaign_elementos.store_id','campaign_stores.store_id')
            ->where('campaign_stores.campaign_id',$request->campaignId)
            ->where('campaign_elementos.id',$request->elementoId)
            ->update([
                'estadorecepcion'=>$request->estadorecepcion,
                'OK'=>$request->estadorecepcion==1 ? '1' : null,
                'KO'=>$request->estadorecepcion>1 ? '1' : null,
                'obsrecepcion'=>$request->obsrecepcion,
                'updated_by'=>auth()->user()->id,
                'fecharecepcion'=>now(),
             ]
            );

            $notification = array(
            'message' => 'Elemento actualizado satisfactoriamente!',
            'alert-type' => 'success',
        );
        return redirect()->route('tienda.edit',[$request->campaignId,$request->storeId])->with($notification);

    }

}
