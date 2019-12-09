<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;
    protected $fillable=['area'];

    public function stores()  
    {
        return $this->hasMany(Store::class);
    }
}
