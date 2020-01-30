<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;

class Store extends Model
{
    protected $fillable=[
        'id','luxotica','name','address','city','province','cp','phone','email',
        'country','zona','area_id','area','idioma','segmento',
        'concepto_id','concepto','imagen',
        'channel','store_cluster','furniture_type','winterschedule','summerschedule',
        'deliverytime','observaciones'
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

    
    public function scopeSeg($query,$campaignId)
    {
        if (CampaignSegmento::where('campaign_id',$campaignId)->count()>0){
            return $query->whereIn('segmento',function($q) use($campaignId){
                $q->select('segmento')->from('campaign_segmentos')->where('campaign_id',$campaignId);
            });}
    }

    public function scopeLux($query,$lux)
    {
        if (!empty($lux)){
            return $query->whereIn('luxotica',$lux);
        }
    }

    public function scopeSto($query,$sto)
    {
        if (!empty($sto)){
            return $query->whereIn('id',$sto);
        }
    }

    public function scopeNam($query,$nam)
    {
        if (!empty($nam)){
            return $query->whereIn('name',$nam);
        }
    }

    public function scopeCoun($query,$coun)
    {
        if (!empty($coun)){
            return $query->whereIn('country',$coun);
        }
    }

    public function scopeAre($query,$are)
    {
        if (!empty($are)){
            return $query->whereIn('area',$are);
        }
    }

    public function scopeSegmen($query,$segmen)
    {
        if (!empty($segmen)){
            return $query->whereIn('segmento',$segmen);
        }
    }

    public function scopeCha($query,$cha)
    {
        if (!empty($cha)){
            return $query->whereIn('channel',$cha);
        }
    }

    public function scopeClu($query,$clu)
    {
        if (!empty($clu)){
            return $query->whereIn('cluster',$clu);
        }
    }

    public function scopeConce($query,$conce)
    {
        if (!empty($conce)){
            return $query->whereIn('concepto',$conce);
        }
    }

    public function scopeFur($query,$fur)
    {
        if (!empty($fur)){
            return $query->whereIn('furniture_type',$fur);
        }
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
            ->resize(null,144,function($constraint){
                $constraint->aspectRatio();
            })
            ->encode('jpg')
            ->save('storage/store/thumbnails/thumb-'.$file_name);

        return $file_name;
    }
}
