<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propxelemento extends Model
{
    public $timestamps = false;
    protected $fillable=['propxelemento'];

    public function elementos()  
    {
        return $this->hasMany(Elemento::class);
    }

}
