<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    public $timestamps = false;
    protected $table = "elementos"; 
    protected $fillable=[
        'elementificador',
        'ubicacion_id',
        'mobiliario_id',
        'propxelemento_id',
        'carteleria_id',
        'medida_id',
        'familia_id',
        'material_id',
        'unitxprop',
        'observaciones'
        ];

        protected $with=['ubica','mobi','propx','carte','medi','mater','famil'];

    public function scopeSearch($query, $busca)
        {
          return $query->where('ubicacion', 'LIKE', "%$busca%")
          ->orWhere('mobiliario', 'LIKE', "%$busca%")
          ->orWhere('carteleria', 'LIKE', "%$busca%")
          ->orWhere('medida', 'LIKE', "%$busca%")
          ->orWhere('material', 'LIKE', "%$busca%")
          ->orWhere('propxelemento', 'LIKE', "%$busca%")
          ->orWhere('observaciones', 'LIKE', "%$busca%")
          ->orWhere('id', 'LIKE', "%$busca%")
          ;
        }

    public function storeelementos()  
    {
        return $this->hasMany(StoreElemento::class);
    }

    public function ubica()  
    {
        return $this->belongsTo(Ubicacion::class,'ubicacion_id');
    }
    
    public function mobi()  
    {
        return $this->belongsTo(Mobiliario::class,'mobiliario_id');
    }
    public function propx()  
    {
        return $this->belongsTo(Propxelemento::class,'propxelemento_id');
    }
    public function carte()  
    {
        return $this->belongsTo(Carteleria::class,'carteleria_id');
    }
    public function medi()  
    {
        return $this->belongsTo(Medida::class,'medida_id');
    }

    public function mater()  
    {
        return $this->belongsTo(Material::class,'material_id');
    }

    public function famil()  
    {
        return $this->belongsTo(Tarifa::class,'familia_id');
    }

}
