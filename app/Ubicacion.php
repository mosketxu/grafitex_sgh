<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    public $timestamps = false;
    protected $fillable=['ubicacion'];

    public function elementos()  
    {
        return $this->hasMany(Elemento::class);
    }
}
