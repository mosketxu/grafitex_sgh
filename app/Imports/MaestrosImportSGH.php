<?php

namespace App\Imports;

use App\Maestro;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class MaestrosImportSGH implements ToModel, WithHeadingRow, WithChunkReading,WithCalculatedFormulas
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $e= str_replace(" ","",$row['ubicacion'].$row['mobiliario'].$row['prop_elemento'].$row['carteleria'].$row['medida'].$row['material'].$row['unit_x_prop']);
        $e=str_replace("/","",$e);
        $observaciones="";
        $udxprop=trim($row['unit_x_prop']); 
        if(!is_numeric($udxprop)){
            $observaciones=$udxprop;
            $udxprop=0;
        }

        $mat=!is_null($row['material'])?$row['material']:'';
        $med=!is_null($row['medida'])?$row['medida']:'';
        $matmed=$mat . $med;
        $sust=array(" ","/","-","(",")","á","é","í",'ó','ú',"Á","É","Í",'Ó','Ú');
        $por=array("","","","","","a","e","i",'o','u',"A","E","I",'O','U');
        $matmed=str_replace($sust, $por, $matmed);
        $matmed=strtolower($matmed);

        return new Maestro([
            'store' => trim($row['store_code']),
            'country' => trim($row['country']), 
            'name' => trim($row['store_name']), 
            'area' => trim($row['area']), 
            'segmento' => trim($row['segment_2019']), 
            'storeconcept' => trim($row['store_concept']), 
            'elementificador'=>$e,
            'ubicacion' => trim($row['ubicacion']), 
            'mobiliario' => trim($row['mobiliario']), 
            'propxelemento' => trim($row['prop_elemento']), 
            'carteleria' => trim($row['carteleria']), 
            'medida' => trim($row['medida']), 
            'material' => trim($row['material']), 
            'matmed'=>$matmed,
            'unitxprop' =>$udxprop, 
            'observaciones'=>$observaciones,
            'channel'=>trim($row['channel']),
            'store_cluster'=>trim($row['store_cluster']),
            'furniture_type'=>trim($row['furniture_type']),
        ]);
    }

    public function chunkSize(): int
    {
        return 300;
    }
}
