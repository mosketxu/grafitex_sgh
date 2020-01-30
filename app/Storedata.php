<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storedata extends Model
{
    protected $fillable=[
        'id','luxotica','address','city','province','cp',
        'phone','email','winterschedule','summerschedule',
        'deliverytime','observaciones'
    ];
}
