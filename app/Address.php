<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable=['id','store_id','address_totstore','address_countrycode','address_channel','address_storename','address_address','address_number','address_city','address_province','address_postalcode','address_phone','address_email','address_storeconcept'];
    protected $dates = ['deleted_at'];

}
