<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storeconcept extends Model
{
    public $timestamps = false;
    protected $fillable=['storeconcept'];

    public function stores()  
    {
        return $this->hasMany(Store::class);
    }
}
