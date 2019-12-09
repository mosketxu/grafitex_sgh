<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $table = "countries"; 
    protected $fillable=['id'];

    public function countries()
    {
        return $this->hasMany(CampaignCountry::class);
    }
}
