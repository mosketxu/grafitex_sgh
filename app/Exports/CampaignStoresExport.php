<?php

namespace App\Exports;

use App\CampaignStore;
use Maatwebsite\Excel\Concerns\{FromCollection,WithHeadings};

class CampaignStoresExport implements FromCollection,WithHeadings
{

    protected $campaign;

    function __construct($campaign) { 
        $this->campaign = $campaign;
    }

    public function headings(): array
    {
        return [
            'Luxotica',
            'Store',
            'Nombre',
            'País',
            'Dirección',
            'Ciudad',
            'Provincia',
            'CP',
            'Tfno.',
            'Email',
            'Horario invierno',
            'Horario Verano',
            'Horario descarga',
            'Observaciones'
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return CampaignStore::join('stores','stores.id','store_id')
            ->select('luxotica','store_id','name','country','address','city','province','cp','phone','email','winterschedule','summerschedule','deliverytime','observaciones')
            ->where('campaign_id', '=', $this->campaign)
            ->get();
        return view('campaign.adresses',compact('stores','campaign'));
    }
}
