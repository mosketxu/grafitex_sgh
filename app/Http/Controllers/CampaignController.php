<?php

namespace App\Http\Controllers;

use App\{
    Store,StoreElemento,Area,Mobiliario,
    Campaign,
    CampaignStore,
    CampaignMedida,
    CampaignMobiliario,
    CampaignUbicacion,
    CampaignSegmento,
    CampaignArea,
    CampaignElemento,
    CampaignGaleria,
    CampaignTienda,
    Medida,
    Segmento,
    Tarifa,
    VCampaignGaleria,
    TarifaFamilia,
    Ubicacion,
    };
use App\Exports\CampaignStoresExport;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// use function Complex\sec;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 
        $campaigns=Campaign::search($request->busca)
        ->orderBy('id','DESC')
        ->paginate();

        return view('campaign.index',compact('campaigns','busqueda'));
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
        $rules=[
            'campaign_name'=>'required|unique:campaigns',
            'campaign_initdate'=>'required',
            'campaign_enddate'=>'required',
        ];

        $messages = [
            'campaign_name.required' => 'Agrega el nombre de la campaña.',
            'campaign_name.unique' => 'El nombre de la campaña ya existe. Usa otro.',
            'campaign_initdate.required' => 'La fecha Inicio es necesaria.',
            'campaign_enddate.required' => 'La fecha Fin es necesaria.',
        ];

        $this->validate($request, $rules, $messages);

        $campaign = Campaign::create($request->all());

        return redirect()->route('campaign.index');
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
        $campaign=Campaign::find($id);
        return view('campaign.edit',compact('campaign'));
    }


    public function addresses($id)
    {
        $campaign=Campaign::find($id);

        $stores=CampaignStore::join('stores','stores.id','store_id')
            ->where('campaign_id', '=', $id)
            ->orderBy('stores.id')
            ->paginate('10')->onEachSide(1);
        return view('campaign.adresses',compact('stores','campaign'));
    }

    public function exportadresses($campaignId)
    {
        return Excel::download(new CampaignStoresExport($campaignId), 'direcciones.xlsx');
    }


    /**
     * Show the form for filtering the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrar($id,Request $request)
    {
        $campaign = Campaign::find($id);

        // stores
        $storesDisponibles=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->select('store_id as store','name')
        ->whereNotIn('store_id', function ($query) use ($id) {
            $query->select('store_id')->from('campaign_stores')->where('campaign_id', '=', $id);
        })
        ->campstoseg($campaign->id)
        ->campstoubi($campaign->id)
        ->campstomob($campaign->id)
        ->campstomed($campaign->id)
        ->groupBy('store','name')
        ->get();

        $storesAsociadas = CampaignStore::select('store_id as store','store as name')->where('campaign_id', '=', $id)->get();
        
        // segmentos
        $segmentosDisponibles=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->select('segmento')
        ->whereNotIn('segmento', function ($query) use ($id) {
            $query->select('segmento')->from('campaign_segmentos')->where('campaign_id', '=', $id);
        })
        ->campstosto($campaign->id)
        ->campstoubi($campaign->id)
        ->campstomob($campaign->id)
        ->campstomed($campaign->id)
        ->groupBy('segmento')
        ->get();
        
        $segmentosAsociadas = CampaignSegmento::where('campaign_id', '=', $id)->get();
        
        // Ubicacion
        $ubicacionesDisponibles=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->select('ubicacion')
        ->whereNotIn('ubicacion', function ($query) use ($id) {
            $query->select('ubicacion')->from('campaign_ubicacions')->where('campaign_id', '=', $id);
        })
        ->campstosto($campaign->id)
        ->campstoseg($campaign->id)
        ->campstomob($campaign->id)
        ->campstomed($campaign->id)
        ->groupBy('ubicacion')
        ->get();
        
        $ubicacionesAsociadas = CampaignUbicacion::where('campaign_id', '=', $id)->get();

        // Medidas 
        $medidasDisponibles=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->select('medida')
        ->whereNotIn('medida', function ($query) use ($id) {
            $query->select('campaign_medidas.medida')->from('campaign_medidas')->where('campaign_id', '=', $id);
        })
        ->campstosto($campaign->id)
        ->campstoseg($campaign->id)
        ->campstoubi($campaign->id)
        ->campstomob($campaign->id)
        ->groupBy('medida')
        ->get();
        
        $medidasAsociadas = CampaignMedida::where('campaign_id', '=', $id)->get();

        // MObiliario
        $mobiliariosDisponibles=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->select('mobiliario')
        ->whereNotIn('mobiliario', function ($query) use ($id) {
            $query->select('mobiliario')->from('campaign_mobiliarios')->where('campaign_id', '=', $id);
        })
        ->campstosto($campaign->id)
        ->campstoseg($campaign->id)
        ->campstoubi($campaign->id)
        ->campstomed($campaign->id)
        ->groupBy('mobiliario')
        ->get();
        
        $mobiliariosAsociadas = CampaignMobiliario::where('campaign_id', '=', $id)->get();
        
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $elementos=StoreElemento::join('stores','stores.id','store_id')
        ->join('elementos','elementos.id','elemento_id')
        ->search($request->busca)
        ->campstosto($campaign->id)
        ->campstoseg($campaign->id)
        ->campstoubi($campaign->id)
        ->campstomob($campaign->id)
        ->campstomed($campaign->id)
        ->paginate(10);

        
        return view('campaign.filtrar', compact(
            'campaign',
            'storesDisponibles','storesAsociadas','medidasDisponibles','medidasAsociadas',
            'mobiliariosDisponibles','mobiliariosAsociadas','ubicacionesDisponibles','ubicacionesAsociadas','segmentosDisponibles',
            'segmentosAsociadas','elementos','busqueda'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'campaign_name' => 'required',
            'campaign_initdate' => 'required',
            'campaign_enddate' => 'required',
            'campaign_state' => 'required',
        ]);

        Campaign::find($id)->update($request->all());

        return redirect()->route('campaign.index')->with('success','Registro actualizado satisfactoriamente');
    }

    public function asociarstore(Request $request)
    {
        // $campaign=$request->campaign_id;
        
        $asociadas = $request->storesduallistbox;
        DB::table('campaign_stores')->where('campaign_id', '=', $request->campaign_id)->delete();
        // $data=array();
        $contador=!is_null($request->storesduallistbox);
        
        if(!is_null($request->storesduallistbox)){
            foreach($asociadas as $asociada){
                if(!empty($asociada)){
                    $c=json_decode($asociada);
                    if(CampaignStore::where('store_id',$c->store)->where('campaign_id',$request->campaign_id)->count()==0)
                        CampaignStore::insert([
                            'campaign_id'=>$request->campaign_id,
                            'store_id'=>$c->store,
                            'store'=>$c->name,
                        ]);
                }
            }
        }
        
        $notification = array(
            'message' => 'Filtro Stores: Actualizado con éxito.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function asociar(Request $request)
    {
            $campaign=$request->campaign_id;
            $asociadas = $request->duallistbox;
            $campo=$request->campo;
            $tabla=$request->tabla;
            
            DB::table($tabla)->where('campaign_id', '=', $campaign)->delete();

            $data=array();
            $contador=!is_null($request->duallistbox);
            if(!is_null($request->duallistbox)){
                // dd($asociadas);
                foreach($asociadas as $asociada){
                    if(!empty($asociada)){
                        $c=json_decode($asociada);
                        if (DB::table($request->tabla)->where($request->campo,$c->$campo)->where('campaign_id',$request->campaign_id)->count()==0)
                            DB::table($tabla)->insert([
                                'campaign_id'=>$campaign,
                                $campo=>$c->$campo
                            ]);
                    }
                }
            }
            $notification = array(
                'message' => 'Filtro '.$request->campo.': Actualizado con éxito.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }


    public function generarcampaign($tipo,$id)
    {
        $campaign = Campaign::find($id);

        //Si empiezo de 0 borrar todo lo generado y regenerar
        if($tipo=="0"){
            if(CampaignTienda::where('campaign_id',$id)->count()>0){
                CampaignTienda::where('campaign_id','=',$id)->delete();
                // elimna en cascada CampaignElemento
            }
            if(CampaignGaleria::where('campaign_id','=',$id)->count()>0){
                CampaignGaleria::where('campaign_id','=',$id)->delete();
            }
        }
        
        //Filtros
        
        // Si no se ha seleccionado ningun Area entiendo que los quiero todos
        if(CampaignArea::where('campaign_id','=',$id)->count()==0){
            $areas=Area::select('area')->get();
            Campaign::inserta('campaign_areas',$areas,'area',$id);
        }
        // Si no se ha seleccionado ningun Medida entiendo que los quiero todos
        if(CampaignMedida::where('campaign_id','=',$id)->count()==0){
            $medidas=Medida::select('medida')->get();
            Campaign::inserta('campaign_medidas',$medidas,'medida',$id);
        }
        // Si no se ha seleccionado ningun Mobiliario entiendo que los quiero todos
        if(CampaignMobiliario::where('campaign_id','=',$id)->count()==0){
            $mobiliarios=Mobiliario::select('mobiliario')->get();
            Campaign::inserta('campaign_mobiliarios',$mobiliarios,'mobiliario',$id);
        }
        // Si no se ha seleccionado ningun segmento entiendo que los quiero todos
        if(CampaignSegmento::where('campaign_id','=',$id)->count()==0){
            $segmentos=Segmento::select('segmento')->get();
            Campaign::inserta('campaign_segmentos',$segmentos,'segmento',$id);
        }
        // Si no se ha seleccionado ningun ubicacion entiendo que los quiero todos
        if(CampaignUbicacion::where('campaign_id','=',$id)->count()==0){
            $ubicacions=Ubicacion::select('ubicacion')->get();
            Campaign::inserta('campaign_ubicacions',$ubicacions,'ubicacion',$id);
        }
        
        // Si no se ha seleccionado ningun store entiendo que los quiero todos
        if(CampaignStore::where('campaign_id','=',$id)->count()==0){
            Store::select('id as store','name')->chunk(100, function ($stores) use($id){
                foreach ($stores as $store) {
                    $existe=CampaignStore::where('store_id',$store['store'])->where('campaign_id',$id)->count();
                    if($existe==0){
                        CampaignStore::insert([
                            'campaign_id'  => $id,
                            'store_id'  => $store['store'],
                            'store'  => $store['name'],
                        ]);
                    };
                }
            });
        }
            
        // Separo en una tabla los stores y en otra todo los elementos de la store
        
        // $tiendas=Maestro::CampaignTiendas($id)->get();
        $tiendas=StoreElemento::join('stores','stores.id','store_id')
            ->join('elementos','elementos.id','elemento_id')
            ->select('store_id as store')
            ->campstosto($campaign->id)
            ->campstoseg($campaign->id)
            ->campstoubi($campaign->id)
            ->campstomob($campaign->id)
            ->campstomed($campaign->id)
            ->groupBy('store','name')
            ->get();
        
        foreach ($tiendas as $tienda) {
            if(CampaignTienda::where('campaign_id',$id)->where('store_id',$tienda->store)->count()==0){
                $tiendaId = CampaignTienda::insertGetId(["campaign_id"=>$id,"store_id"=>$tienda->store]);
            }
            else{
                $tiendaId=CampaignTienda::where('campaign_id',$id)->where('store_id',$tienda->store)->first()->id;
            }
        
            $t=$tienda->store;
            
            $generar=StoreElemento::join('stores','stores.id','store_id')
            ->join('elementos','elementos.id','elemento_id')
            ->campstoubi($campaign->id)
            ->campstomob($campaign->id)
            ->campstomed($campaign->id)
            ->where('store_id',$t)
            ->get();
        
            foreach ($generar as $gen){
                if ($gen['country']=='PT'){
                    $zona='PT';
                }else{
                    if($gen['area']=='Canarias')
                    $zona='CN';
                    else
                    $zona='ES';
                }
                $familia=TarifaFamilia::getFamilia($gen['material'],$gen['medida']);
                $fam=$familia['id'];
                
                if (is_null($fam))
                $fam=1;

                $elemento=$gen['mobiliario'].$gen['carteleria'].$gen['medida'];
                $sust=array(" ","/","-","+",".","(",")","á","é","í",'ó','ú',"Á","É","Í",'Ó','Ú');
                $por=array("","","","","","","","a","e","i",'o','u',"A","E","I",'O','U');
                
                if(substr($gen['name'],0,3)==='ECI')
                    $eci='ECI';
                else
                    $eci='';
                $elemento=strtolower(str_replace($sust, $por, $elemento)).$eci;

                $imagen=$elemento.'.jpg';
                $mat=!is_null($gen['material'])?$gen['material']:'';
                $med=!is_null($gen['medida'])?$gen['medida']:'';
                $matmed=$mat . $med;
                $sust=array(" ","/","-","(",")","á","é","í",'ó','ú',"Á","É","Í",'Ó','Ú');
                $por=array("","","","","","a","e","i",'o','u',"A","E","I",'O','U');
                $matmed=str_replace($sust, $por, $matmed);
                $matmed=strtolower($matmed);
            
                
                $i=CampaignElemento::insert([
                    'tienda_id'  => $tiendaId,
                    'elemento_id'  => $gen['elemento_id'],
                    'store_id'  => $gen['store_id'],
                    'name'  => $gen['name'],
                    'country'  => $gen['country'],
                    'idioma'  => $gen['idioma'],
                    'area'  => $gen['area'],
                    'zona'  => $zona,
                    'segmento'  => $gen['segmento'],
                    'storeconcept'  => $gen['concepto'],
                    'ubicacion'  => $gen['ubicacion'],
                    'mobiliario'  => $gen['mobiliario'],
                    'propxelemento'  => $gen['propxelemento'],
                    'carteleria'  => $gen['carteleria'],
                    'medida'  => $gen['medida'],
                    'material'  => $gen['material'],
                    'matmed'  => $gen['matmed'],
                    'familia'=>$fam,
                    'unitxprop'  => $gen['unitxprop'], 
                    'imagen'  => $imagen,
                    'elemento'  => $elemento,
                    'ECI'=>$eci,
                ]);
            }
        }
            
        //relleno la tabla imagenes
        // $imagenes=VCampaignGaleria::getGaleria($id);
        $imagenes=CampaignElemento::getGaleria($id);
        // dd($imagenes);
        foreach (array_chunk($imagenes->toArray(),1000) as $t){
            $dataSet = [];
            foreach ($t as $gen) {
                $dataSet[] = [
                    'campaign_id'  => $id,
                    'mobiliario'  => $gen['mobiliario'],
                    'carteleria'  => $gen['carteleria'],
                    'medida'  => $gen['medida'],
                    'elemento'  => $gen['elemento'],
                    'eci'  => $gen['ECI'],
                    'imagen'  => $gen['imagen'],
                ];
            }
            DB::table('campaign_galerias')->insert($dataSet);
        }

    return redirect()->route('campaign.elementos', $campaign);
}

    public function conteo($campaignId, Request $request) 
    {
        if ($request->busca) { 
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 
    
        $campaign = Campaign::find($campaignId);
        $total=CampaignElemento::tienda($campaignId)->count();
        $totalstores=CampaignTienda::where('campaign_id',$campaignId)->count();
        
        
        $conteodetallado=CampaignElemento::tienda($campaignId)
            ->search($request->busca)
            ->select('segmento','ubicacion','medida','mobiliario','area','material', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
            ->groupBy('segmento','ubicacion','medida','mobiliario','area','material')
            ->paginate('50');
            
        $tiendaszonas= CampaignTienda::storeElemento($campaignId)
        ->select('campaign_elementos.country as country','campaign_elementos.area as area', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('country','area')
        ->get();
        
        $materiales=  CampaignElemento::tienda($campaignId)
        ->select('material', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('material')
        ->get();
        
        $segmentos= CampaignElemento::tienda($campaignId)
        ->select('segmento', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('segmento')
        ->get();
        
        $conceptos=CampaignElemento::tienda($campaignId)
        ->select('storeconcept', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('storeconcept')
        ->get();
        
        $mobiliarios=CampaignElemento::tienda($campaignId)
        ->select('mobiliario', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('mobiliario')
        ->get();
        
        $propxelementos=CampaignElemento::tienda($campaignId)
        ->select('propxelemento', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('propxelemento')
        ->get();
        
        $cartelerias=CampaignElemento::tienda($campaignId)
        ->select('carteleria', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('carteleria')
        ->get();
        
        $medidas=CampaignElemento::tienda($campaignId)
        ->select('medida', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('medida')
        ->get();
        
        $materialmedidas=CampaignElemento::tienda($campaignId)
        ->join('tarifas','tarifas.id','campaign_elementos.familia')
        ->select('tarifas.familia as tfam','campaign_elementos.familia','matmed','material','medida', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('tarifas.familia','familia','matmed','material','medida')
        ->get();

        $tarifas=Tarifa::where('tipo','0')->get();
        
        $idiomamatmobmedidas=CampaignElemento::tienda($campaignId)
        ->select('idioma','material','medida','mobiliario', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('idioma','material','medida','mobiliario')
        ->get();

        return view('campaign.conteos', 
            compact('campaign','conteodetallado','tiendaszonas','materiales','segmentos',
                'conceptos','mobiliarios','propxelementos','cartelerias','medidas',
                'materialmedidas','tarifas','idiomamatmobmedidas','busqueda'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Campaign::where('id',$id)->delete();


         $notification = array(
            'message' => '¡Campaña eliminada satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
