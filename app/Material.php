<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $table = "materiales";
    protected $fillable=['material'];

    
    public function elementos()  
    {
        return $this->hasMany(Elemento::class);
    }


}
