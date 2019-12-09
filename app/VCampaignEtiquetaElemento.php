<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCampaignEtiquetaElemento extends Model
{
    protected $table = "v_campaign_etiqueta_elementos"; 

    public function campaignetiquetastore(){
        return $this->belongsTo(CampaignEtiquetaStore::class);
    }
}
