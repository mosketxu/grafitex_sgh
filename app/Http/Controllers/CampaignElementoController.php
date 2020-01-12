<?php

namespace App\Http\Controllers;

use App\{Campaign,CampaignElemento, CampaignTienda};
use Illuminate\Http\Request;
use App\Exports\{CampaignElemenIdiMatMedMobExport, CampaignElementosExport};
use Maatwebsite\Excel\Facades\Excel;

use Image;
 
class CampaignElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaignId, Request $request)
    {
        
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $campaign = Campaign::find($campaignId);
        
        $elementos= CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->search($request->busca)
        ->where('campaign_id',$campaignId)
        ->select('campaign_elementos.id as id','campaign_elementos.store_id as store_id','name','country','area','segmento','storeconcept',
            'ubicacion','mobiliario','propxelemento','carteleria','medida',
            'material','familia','precio','unitxprop','imagen','observaciones')
        ->orderBy('store_id')
        ->paginate('25');

        return view('campaign.elementos.index', compact('campaign','elementos','busqueda'));    
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
        //
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
    public function edit($campaignId,$elementoId)
    {
        $campaign=Campaign::find($campaignId);
        $campaignelemento=CampaignElemento::where('id',$elementoId)->first();

        return view('campaign.elementos.edit',compact('campaign','campaignelemento'));
    }

    public function editelemento($campaignId,$elementoId)
    {
        $campaign=Campaign::find($campaignId);
        $campaignelemento=CampaignElemento::where('id',$elementoId)->first();

        return view('campaign.elementos.edit',compact('campaign','campaignelemento'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * dd(@param);
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // solo actulizo los campos, la imagen no lo hago desde aquí;
        $campElem=json_decode($request->campaignelemento);
        // dd($request);
        $campaignelem=CampaignElemento::find($campElem->id);
        $campaignelem->observaciones=$request->observaciones;
        $campaignelem->precio=$request->precio;
        $campaignelem->save();

        $campaign=Campaign::find($campaignelem->campaign_id);
        $elementos=CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->where('campaign_id',$campaignelem->campaign_id)
        ->orderBy('store_id')
        ->paginate('5');

        return view('campaign.elementos.index',compact('campaign','elementos'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateimagenindex(Request $request)
    {

        $request->validate([
            'photo' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:12288',
            ]);
        $campElem=CampaignElemento::find($request->elementoId);
        $tienda=CampaignTienda::find($campElem->tienda_id);
        $campaignId=$tienda->campaign_id;

        // json_decode($request->campaigngaleria);
        
        //Por si me interesa estos datos de la imagen
        $extension=$request->file('photo')->getClientOriginalExtension();
        $tipo=$request->file('photo')->getClientMimeType();
        $nombre=$request->file('photo')->getClientOriginalName();
        $tamanyo=$request->file('photo')->getClientSize();
        
        // Genero el nombre que le pondré a la imagen
        $file_name=$nombre; 
        
        // Si no existe la carpeta la creo
        $ruta = public_path().'/storage/galeria/'.$campaignId;
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
            mkdir($ruta.'/thumbnails', 0777, true);
        }


        // verifico si existe la imagen y la borro si existe. Busco el nombre que debería tener.
        $mi_imagen = $ruta.'/'.$file_name;
        $mi_imagenthumb = $ruta.'/thumbails/'.$file_name;

        if (@getimagesize($mi_imagen)) {
            unlink($mi_imagen);
        }
        if (@getimagesize($mi_imagenthumb)) {
            unlink($mi_imagenthumb);
        }
        
        // verifico que realmente llega un fichero
        if($files=$request->file('photo')){
            // for save the original image
            $imageUpload=Image::make($files)->encode('jpg');
            $originalPath='storage/galeria/'.$campaignId.'/';
            $imageUpload->save($originalPath.$file_name);
            $campElem->imagen=$nombre;
            $campElem->save();

            Image::make($request->file('photo'))
                ->resize(144,144)
                ->encode('jpg')
                ->save('storage/galeria/'.$campaignId.'/thumbnails/thumb-'.$file_name);
        }

        // grabo el nuevo nombre de la imagen en 
        
        $campElem->imagen = $file_name;
        $campElem->save();

        return response()->json($campElem);
    }

    public function exportConteoIdiomaMatMedMob($campaignId)
    {
        return Excel::download(new CampaignElemenIdiMatMedMobExport($campaignId), 'estadistica.xlsx');
    }

    public function exportCampaignElementos($campaignId)
    {
        return Excel::download(new CampaignElementosExport($campaignId), 'campaignelementos.xlsx');
    }
    

}
