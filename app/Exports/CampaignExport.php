<?php

namespace App\Exports;

use App\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;

class CampaignExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Campaign::all();
    }
}
