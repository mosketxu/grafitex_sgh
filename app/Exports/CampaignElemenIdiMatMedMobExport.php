<?php

namespace App\Exports;

use App\CampaignElemento;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaignElemenIdiMatMedMobExport implements FromCollection,WithHeadings
{

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection 
    */

    public function headings(): array
    {
        return [
            'Country',
            'Material',
            'Medidas',
            'Mobiliarios',
            'Totales',
            'Unidades',
        ];
    }
    public function collection()
    {
        return CampaignElemento::join('campaign_tiendas','campaign_tiendas.id','tienda_id')
        ->where('campaign_id',$this->id)
        ->select('idioma','material','medida','mobiliario', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('idioma','material','medida','mobiliario')
        ->get();
    }
}
