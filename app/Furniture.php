<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    public $timestamps = false;
    protected $table = "furnitures"; 
    protected $fillable=['furniture'];

}
