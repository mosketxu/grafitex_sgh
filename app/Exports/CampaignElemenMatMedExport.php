<?php

namespace App\Exports;

use App\CampaignElemento;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaignElemenMatMedExport implements FromCollection,WithHeadings
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function headings(): array
    {
        return [
            'Material',
            'Medida',
            'Totales',
            'Unidades',
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  CampaignElemento::tienda($this->id)
        ->select('material','medida', DB::raw('count(*) as totales'),DB::raw('SUM(unitxprop) as unidades'))
        ->groupBy('material','medida')
        ->get();

    }
}
