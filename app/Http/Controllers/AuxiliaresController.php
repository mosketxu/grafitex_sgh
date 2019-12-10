<?php

namespace App\Http\Controllers;

use App\{Area,Carteleria,Country, Material, Medida, Mobiliario,Propxelemento,Segmento,Storeconcept,Ubicacion};
use Illuminate\Http\Request;

class AuxiliaresController extends Controller
{
    public function index()
    {
        $countries=Country::get();
        $areas=Area::orderBy('area')->get();
        $segmentos=Segmento::orderBy('segmento')->get();
        $conceptos=Storeconcept::orderBy('storeconcept')->get();
        $ubicaciones=Ubicacion::orderBy('ubicacion')->get();
        $mobiliarios=Mobiliario::orderBy('mobiliario')->get();
        $propxelementos=Propxelemento::orderBy('propxelemento')->get();
        $cartelerias=Carteleria::orderBy('carteleria')->get();
        $medidas=Medida::orderBy('medida')->get();
        $materiales=Material::orderBy('material')->get();
        return view('auxiliares.index',compact('countries','areas','segmentos','conceptos','ubicaciones','mobiliarios','propxelementos','cartelerias','medidas','materiales'));
    }
}
