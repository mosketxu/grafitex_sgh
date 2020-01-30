<?php

namespace App\Imports;

use App\Storedata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StoredataImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row['code']);
        return new Storedata([
            'id'=>$row['code'],
            'luxotica'=>$row['luxottica'],
            'address'=>$row['address'],
            'city'=>$row['city'],
            'province'=>$row['province'],
            'cp'=>$row['postal_code'],
            'phone'=>$row['phone'],
            'email'=>$row['email'],
            'winterschedule'=>substr($row['winnter_schedule'],0,30),
            'summerschedule'=>substr($row['summer_schedule'],0,30),
            'deliverytime'=>substr($row['delivery_time'],0,49),
            'observaciones'=>substr($row['observations'],0,80),
        ]);
    }
}