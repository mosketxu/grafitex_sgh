<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;

class Store extends Model
{
    protected $fillable=[
        'id','name','country',
        'zona','area_id','area','idioma','segmento',
        'concepto_id','concepto','observaciones','imagen',
        'channel','store_cluster','furniture_type'
    ];

    protected $with=['are','concep','storeelementos'];

        
    // public function campaignelemen()
    // {
        //     return $this->hasMany(CampaignElemento::class,'store_id');
        // }
            
    public function campaigntiendas()
    {
        return $this->hasMany(CampaignTienda::class);
    }
    
    
    public function storeelementos()
    {
        return $this->hasMany(StoreElemento::class);
    }
    
    public function are()  
    {
        return $this->belongsTo(Area::class,'area_id');
    }
    
    
    public function concep()  
    {
        return $this->belongsTo(Storeconcept::class,'concepto_id');
    }

    public function scopeSearch($query, $busca)
    {
        return $query->where('id', 'LIKE', "%$busca%")
        ->orWhere('name', 'LIKE', "%$busca%")
        ->orWhere('country', 'LIKE', "%$busca%")
        ->orWhere('idioma', 'LIKE', "%$busca%")
        ->orWhere('zona', 'LIKE', "%$busca%")
        ->orWhere('area', 'LIKE', "%$busca%")
        ->orWhere('segmento', 'LIKE', "%$busca%")
        ->orWhere('channel', 'LIKE', "%$busca%")
        ->orWhere('store_cluster', 'LIKE', "%$busca%")
        ->orWhere('concepto', 'LIKE', "%$busca%")
        ->orWhere('furniture_type', 'LIKE', "%$busca%")
        ->orWhere('observaciones', 'LIKE', "%$busca%")
        ->orWhere('imagen', 'LIKE', "%$busca%")
        ;
    }

    public function scopeSeg($query,$campaignId)
    {
        if (CampaignSegmento::where('campaign_id',$campaignId)->count()>0){
            return $query->whereIn('segmento',function($q) use($campaignId){
                $q->select('segmento')->from('campaign_segmentos')->where('campaign_id',$campaignId);
            });}
    }


    static function subirImagen($storeId,$imagen)
    {
        //Por si me interesa estos datos de la imagen
        $extension=$imagen->getClientOriginalExtension();
        $tipo=$imagen->getClientMimeType();
        $nombre=$imagen->getClientOriginalName();
        $tamayo=$imagen->getClientSize();

        // Genero el nombre que le pondré a la imagen
        $file_name=$storeId.'.jpg'; 

        // Si no existe la carpeta la creo
        $ruta = public_path().'/storage/store';
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
        if($files=$imagen){
            // for save the original image
            $imageUpload=Image::make($files)->encode('jpg');
            $originalPath='storage/store/';
            $imageUpload->save($originalPath.$file_name);
        }

        Image::make($imagen)
            ->resize(144,144)
            ->encode('jpg')
            ->save('storage/store/thumbnails/thumb-'.$file_name);

        return $file_name;
    }
}
