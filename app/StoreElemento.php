<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreElemento extends Model
{

    protected $fillable=['id','elemento_id','store_id','elementificador'];

    protected $with=['elemen'];

    public function scopeSearch($query, $busca)
    {
      return $query->where('ubicacion', 'LIKE', "%$busca%")
      ->orWhere('mobiliario', 'LIKE', "%$busca%")
      ->orWhere('carteleria', 'LIKE', "%$busca%")
      ->orWhere('medida', 'LIKE', "%$busca%")
      ->orWhere('material', 'LIKE', "%$busca%")
      ->orWhere('propxelemento', 'LIKE', "%$busca%")
      ->orWhere('observaciones', 'LIKE', "%$busca%")
      ;
    }

    public function scopeUbicacion($query,$ubicacion)
    {
        if($ubicacion)
            return $query->where('ubicacion','LIKE',"%$ubicacion%");
    }
    public function scopeMobiliario($query,$mobiliario)
    {
        if($mobiliario)
            return $query->where('mobiliario','LIKE',"%$mobiliario%");
    }
    public function scopeCarteleria($query,$carteleria)
    {
        if($carteleria)
            return $query->where('carteleria','LIKE',"%$carteleria%");
    }
    public function scopeMaterial($query,$material)
    {
        if($material)
            return $query->where('material','LIKE',"%$material%");
    }
    public function scopePropxelemento($query,$propxelemento)
    {
        if($propxelemento)
            return $query->where('propxelemento','LIKE',"%$propxelemento%");
    }


    public function elemen()
    {
        return $this->belongsTo(Elemento::class,'elemento_id');
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    
}
