<?php

namespace App\Exports;

use App\Store;
use Maatwebsite\Excel\Concerns\FromCollection,Maatwebsite\Excel\Concerns\WithHeadings;

class StoreExport implements FromCollection,WithHeadings
{

    protected $lux;
    protected $sto;
    protected $nam;
    protected $coun;
    protected $are;
    protected $segmen;
    protected $cha;
    protected $clu;
    protected $fur;

    function __construct($lux,$sto,$nam,$coun,$are,$segmen,$cha,$clu,$fur) { 
        $this->lux = $lux;
        $this->sto = $sto;
        $this->nam = $nam;
        $this->coun = $coun;
        $this->are= $are;
        $this->segmen = $segmen;
        $this->cha = $cha;
        $this->clu = $clu;
        $this->fur = $fur;
    }

    public function headings(): array
    {
        return [
            'Luxotica',
            'Store',
            'Name',
            'Country',
            'Area',
            'Segmento',
            'Channel',
            'Cluster',
            'Furniture',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    { 
        return Store::select('luxotica','id','name','country','area','segmento','channel','store_cluster','furniture_type')
            ->lux($this->lux)
            ->sto($this->sto)
            ->nam($this->nam)
            ->coun($this->coun)
            ->are($this->are)
            ->segmen($this->segmen)
            ->cha($this->cha)
            ->clu($this->clu)
            ->fur($this->fur)
            ->get();
    
    }
}