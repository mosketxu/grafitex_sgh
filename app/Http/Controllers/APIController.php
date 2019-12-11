<?php

namespace App\Http\Controllers;


use App\{Campaign,CampaignElemento, Country, Area,Carteleria, Maestro, Material, Medida, Mobiliario, Propxelemento, Segmento, Ubicacion, Storeconcept};
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{ 
    public function getMaestros(){
        $query=Maestro::select('store','country','name','area','segmento','storeconcept','ubicacion','mobiliario','propxelemento','carteleria','medida','material','unitxprop');
        
        return datatables($query)
        ->make(true);
    }

    public function getCampaigns(){
        $query=Campaign::select('id','campaign_name','campaign_initdate','campaign_enddate','campaign_state','created_at','updated_at');
        return datatables($query)
        ->addColumn('btn','campaign._actionCampaign')
        ->rawColumns(['btn'])
        ->make(true);
    }


    public function getcountry(){
        $query = Country::select('id','country')->get();
        return datatables($query)
        ->make(true);
    }
    public function getarea(){
        $query = Area::select('id','area')->get();
        return datatables($query)
        ->make(true);
    }
    public function getsegmento(){
        $query = Segmento::select('id','segmento')->get();
        return datatables($query)
        ->make(true);
    }
    public function getubicacion(){
        $query = Ubicacion::select('id','ubicacion')->get();
        return datatables($query)
        ->make(true);
    }
    public function getStoreconcept(){
        $query = Storeconcept::select('id','storeconcept')->get();
        return datatables($query)
        ->make(true);
    }
    public function getmobiliario(){
        $query = Mobiliario::select('id','mobiliario')->get();
        return datatables($query)
        ->make(true);
    }
    public function getpropxelemento(){
        $query = Propxelemento::select('id','propxelemento')->get();
        return datatables($query)
        ->make(true);
    }
    public function getcarteleria(){
        $query = Carteleria::select('id','carteleria')->get();
        return datatables($query)
        ->make(true);
    }
    public function getmedida(){
        $query = Medida::select('id','medida')->get();
        return datatables($query)
        ->make(true);
    }
    public function getmaterial(){
        $query = Material::select('id','material')->get();
        return datatables($query)
        ->make(true);
    }


}