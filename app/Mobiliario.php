<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobiliario extends Model
{
    public $timestamps = false;
    protected $fillable=['mobiliario'];

    public function elementos()  
    {
        return $this->hasMany(Elemento::class);
    }

}
