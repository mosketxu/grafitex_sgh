<?php

namespace App\Http\Controllers;

use App\{Campaign,CampaignGaleria};
use Image;
use Illuminate\Http\Request;


class CampaignGaleriaController extends Controller
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

        $campaign=Campaign::find($campaignId);
        $campaigngaleria=CampaignGaleria::search($request->busca)
        ->where('campaign_id',$campaignId)
        ->orderBy('elemento')
        ->paginate('10')->onEachSide(2);
        // ->get();
        $totalGaleria=CampaignGaleria::where('campaign_id',$campaignId)->count();

        return view('campaign.galeria.index',compact('campaign','campaigngaleria','totalGaleria','busqueda'));
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
    public function edit($campaignId,$imagenId)
    {
        $campaign=Campaign::find($campaignId);
        $campaigngaleria=CampaignGaleria::where('id',$imagenId)->first();

        return view('campaign.galeria.edit',compact('campaign','campaigngaleria'));
    }

    public function editgaleria($campaignId,$imagenId)
    {
        $campaign=Campaign::find($campaignId);
        $campaigngaleria=CampaignGaleria::where('id',$imagenId)->first();

        return view('campaign.galeria.edit',compact('campaign','campaigngaleria'));
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
        // solo actulizo los campos, la imagen no lo hago desde aquí;
        $campGal=json_decode($request->campaigngaleria);
        $campaigngal=CampaignGaleria::find($campGal->id);
        $campaigngal->observaciones=$request->observaciones;
        $campaigngal->save();

       
        $campaign=Campaign::find($campaigngal->campaign_id);
        $campaigngaleria=CampaignGaleria::where('campaign_id',$campaigngal->campaign_id)->get();

        return view('campaign.galeria',compact('campaign','campaigngaleria'));

        // return Response()->json($campaigngaleria);
    }



     public function updateimagen(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:12288',
        ]);
        


        $campGal=json_decode($request->campaigngaleria);


        //Por si me interesa estos datos de la imagen
        $extension=$request->file('photo')->getClientOriginalExtension();
        $tipo=$request->file('photo')->getClientMimeType();
        $nombre=$request->file('photo')->getClientOriginalName();
        $tamayo=$request->file('photo')->getClientSize();
        
        // Genero el nombre que le pondré a la imagen
        $file_name=$campGal->elemento.'-'.$campGal->campaign_id.'.'.$extension;

        // verifico si existe la imagen y la borro si existe. Busco el nombre que debería tener.
        $mi_imagen = public_path().'/storage/galeria/'.$file_name;
        $mi_imagenthumb = public_path().'/storage/galeria/thumbails/thumb-'.$file_name;
        if (@getimagesize($mi_imagen)) {
            unlink($mi_imagen);
        }
        if (@getimagesize($mi_imagenthumb)) {
            unlink($mi_imagenthumb); 
        }

        // verifico que realmente llega un fichero
        if($files=$request->file('photo')){
            // for save the original
            $imageUpload=Image::make($files);
            $originalPath='storage/galeria/';
            $imageUpload->save($originalPath.$file_name);
            //redimensionando
            Image::make($request->file('photo'))
            ->resize(144,144)
            ->save('storage/galeria/thumbnails/thumb-'.$file_name);
        }

        $campaigngaleria=CampaignGaleria::find($campGal->id);
        $campaigngaleria->imagen = $file_name;
        $campaigngaleria->save();

        // $image = CampaignGaleria::latest()->first(['photo_name']);
        return Response()->json($campaigngaleria);

        // return back()
        //     ->with('success', 'You have successfully upload image.');
    }
   
    public function updateimagenindex(Request $request)
    {
        // dd('llego');
        $request->validate([
            'photo' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:12288',
            ]);
            
        $campGal=CampaignGaleria::find($request->imagenId);
        // json_decode($request->campaigngaleria);
        
        //Por si me interesa estos datos de la imagen
        $extension=$request->file('photo')->getClientOriginalExtension();
        $tipo=$request->file('photo')->getClientMimeType();
        $nombre=$request->file('photo')->getClientOriginalName();
        $tamayo=$request->file('photo')->getClientSize();
        
        // Genero el nombre que le pondré a la imagen
        $file_name=$campGal->elemento.'.jpg'; 
        
        // Si no existe la carpeta la creo
        $ruta = public_path().'/storage/galeria/'.$campGal->campaign_id;
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
            $originalPath='storage/galeria/'.$campGal->campaign_id.'/';
            $imageUpload->save($originalPath.$file_name);
        }

        Image::make($request->file('photo'))
            ->resize(144,144)
            ->encode('jpg')
            ->save('storage/galeria/'.$campGal->campaign_id.'/thumbnails/thumb-'.$file_name);

        $campaigngaleria=CampaignGaleria::find($campGal->id);
        $campaigngaleria->imagen = $file_name;
        $campaigngaleria->save();

        // $image = CampaignGaleria::latest()->first(['photo_name']);
        return Response()->json($campaigngaleria);

        // return back()
        //     ->with('success', 'You have successfully upload image.');
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
}
