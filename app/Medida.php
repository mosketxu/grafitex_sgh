<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    public $timestamps = false;
    protected $fillable=['medida'];

    public function elementos()  
    {
        return $this->hasMany(Elemento::class);
    }


}
