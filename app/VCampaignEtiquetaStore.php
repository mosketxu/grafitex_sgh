<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCampaignEtiquetaStore extends Model
{
    protected $table = "v_campaign_etiqueta_stores"; 

    public function campaignetiquetaelemento(){
        return $this->hasMany(CampaignEtiquetaElemento::class);
    }

}
