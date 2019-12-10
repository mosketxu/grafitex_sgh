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

    public function elemen()
    {
        return $this->belongsTo(Elemento::class,'elemento_id');
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    
}
