<?php

namespace App\Exports;

use App\CampaignElemento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaignElementosExport implements FromCollection,WithHeadings
{

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function headings(): array
    {
        return [
            'Store',
            'Name',
            'Country',
            'Area',
            'Zona',
            'Segmento',
            'Concept',
            'Ubicacion',
            'Mobiliario',
            'PropXelemento',
            'Carteleria',
            'Medida',
            'Material',
            'UnitXprop',
            'Imagen',
            'Observaciones',
            'precio',
            'creado',
            'actualizado',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CampaignElemento::where('campaign_id',$this->id)
        ->select('store_id','name','country','area','zona','segmento',
                'storeconcept','ubicacion','mobiliario','propxelemento',
                'carteleria','medida','material','unitxprop','imagen',
                'observaciones','precio','created_at','updated_at')
        ->orderBy('store_id')
        ->get();
    }
}
