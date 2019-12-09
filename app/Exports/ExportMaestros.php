<?php

namespace App\Exports;

use App\Maestro;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportMaestros implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Maestro::get();
    }
}
