<?php

namespace App\Http\Controllers;

use App\Imports\MaestrosImport;
use App\{Maestro,Ubicacion,Area, Carteleria, Country, Material, Medida, Mobiliario, Segmento, Storeconcept,Propxelemento};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MaestroController extends Controller
{


    public function index()
    {
        return view('maestro.index');
    }


    public function import(Request $request)
    {

        $request->validate([
            'maestro' => 'required|mimes:xls,xlsx',
            ]);
            
        DB::table('maestros')->delete();

        try{
            (new MaestrosImport)->import(request()->file('maestro'));   
        }catch(\ErrorException $ex){
            return back()->withError($ex->getMessage());
        }

        $notification = array(
            'message' => '¡Maestro importado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return redirect('/maestro')->with($notification);
        
    }

    public function actualizarTablas()
    {
          
        DB::table('store_elementos')->delete();
        DB::table('elementos')->delete();
        DB::table('stores')->delete();
        DB::table('ubicacions')->delete();
        DB::table('areas')->delete();
        DB::table('cartelerias')->delete();
        DB::table('medidas')->delete();
        DB::table('mobiliarios')->delete();
        DB::table('segmentos')->delete();
        DB::table('propxelementos')->delete();
        DB::table('storeconcepts')->delete();
        DB::table('materiales')->delete();

        Ubicacion::insert(Maestro::select('ubicacion')->distinct('ubicacion')->get()->toArray());
        Area::insert(Maestro::select('area')->distinct('area')->get()->toArray());
        Carteleria::insert(Maestro::select('carteleria')->distinct('carteleria')->get()->toArray());
        Medida::insert(Maestro::select('medida')->distinct('medida')->get()->toArray());
        Mobiliario::insert(Maestro::select('mobiliario')->distinct('mobiliario')->get()->toArray());
        Propxelemento::insert(Maestro::select('propxelemento')->distinct('propxelemento')->get()->toArray());
        Segmento::insert(Maestro::select('segmento')->distinct('segmento')->get()->toArray());
        Storeconcept::insert(Maestro::select('storeconcept')->distinct('storeconcept')->get()->toArray());
        Material::insert(Maestro::select('material')->distinct('material')->get()->toArray());

        Maestro::insertStores();
        Maestro::insertElementos();
        Maestro::insertStoreElementos();

        $notification = array(
            'message' => '¡Tablas principales actualizadas satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return redirect('/maestro')->with($notification);
        
    }
}