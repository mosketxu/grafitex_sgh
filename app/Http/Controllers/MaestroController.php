<?php

namespace App\Http\Controllers;

use App\Imports\{MaestrosImport, MaestrosImportSGH};
use App\{Maestro,Ubicacion,Area, Carteleria, Country, Furniture, Material, Medida, Mobiliario, Segmento, Storeconcept,Propxelemento, TarifaFamilia};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MaestroController extends Controller
{


    public function index(Request $request)
    {
        $sto=$request->get('sto');
        $nam=$request->get('nam');
        $coun=$request->get('coun');
        $are=$request->get('are');
        $seg=$request->get('seg');
        $cha=$request->get('cha');
        $clu=$request->get('clu');
        $conce=$request->get('conce');
        $fur=$request->get('fur');
        $ubi=$request->get('ubi');
        $mob=$request->get('mob');
        $cart=$request->get('cart');
        $mat=$request->get('mat');
        $med=$request->get('med');
        $propx=$request->get('propx');

        $maestros=Maestro::sto($request->sto)
        ->nam($request->nam)
        ->coun($request->coun)
        ->are($request->are)
        ->seg($request->seg)
        ->conce($request->conce)
        ->ubi($request->ubi)
        ->mob($request->mob)
        ->cart($request->cart)
        ->mat($request->mat)
        ->med($request->med)
        ->propx($request->propx)
        ->paginate(10);

        return view('maestro.index',compact('maestros','sto','nam','coun','are','seg','cha','clu','conce','fur','ubi','mob','cart','mat','med','propx'));
    }
 

    public function import(Request $request,$origen)
    {
        $request->validate([
            'maestro' => 'required|mimes:xls,xlsx',
            ]);
            
        DB::table('maestros')->delete();
            
        try{
            if($origen=="Grafitex"){
                (new MaestrosImport)->import(request()->file('maestro'));   
            }else{
                (new MaestrosImportSGH)->import(request()->file('maestro'));   
            }
        }catch(\ErrorException $ex){
            // dd($ex->getMessage());
            return back()->withError($ex->getMessage());
        }

        $notification = array(
            'message' => '¡Maestro importado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return redirect('/maestro')->with($notification);
        
    }

    public function actualizarTablas($origen)
    {
        // $tarifafamilias=TarifaFamilia::get();
        // foreach ($tarifafamilias as $tf){
        //     $mat=!is_null($tf->material)?$tf->material:'';
        //     $med=!is_null($tf->medida)?$tf->medida:'';
        //     $e=$mat . $med;
        //     $sust=array(" ","/","-","(",")","á","é","í",'ó','ú',"Á","É","Í",'Ó','Ú');
        //     $por=array("","","","","","a","e","i",'o','u',"A","E","I",'O','U');
        //     $e=str_replace($sust, $por, $e);
        //     $e=strtolower($e);
        //     TarifaFamilia::where('id',$tf->id)->update[
        //         'matmed'=$e
        //         ]
        //     );
        // }

        //elimino los elementos de las stores para volver a añadirlos
        DB::table('store_elementos')->delete();
        DB::table('elementos')->delete(); // si no los elimino es muy lento y salta

        //No elimino nada más. Intento actualizar sin mas.
        // DB::table('stores')->delete();
        // DB::table('ubicacions')->delete();
        // DB::table('areas')->delete();
        // DB::table('cartelerias')->delete();
        // DB::table('medidas')->delete();
        // DB::table('mobiliarios')->delete();
        // DB::table('segmentos')->delete();
        // if($origen=="SGH")
        //     DB::table('furnitures')->delete();
        // DB::table('propxelementos')->delete();
        // DB::table('storeconcepts')->delete();
        // DB::table('materiales')->delete();

        //Inserto actualizo Ubicaciones
        $ubicaciones=Maestro::select('ubicacion')->distinct('ubicacion')->get()->toArray();
        foreach ($ubicaciones as $ubicacion){
            Ubicacion::firstOrCreate($ubicacion);
        }
        // Ubicacion::insert(Maestro::select('ubicacion')->distinct('ubicacion')->get()->toArray());
        $areas=Maestro::select('area')->distinct('area')->get()->toArray();
        foreach ($areas as $area){
            Area::firstOrCreate($area);
        }
        // Area::insert(Maestro::select('area')->distinct('area')->get()->toArray());
        $cartelerias=Maestro::select('carteleria')->distinct('carteleria')->get()->toArray();
        foreach ($cartelerias as $carteleria){
            Carteleria::firstOrCreate($carteleria);
        }
        // Carteleria::insert(Maestro::select('carteleria')->distinct('carteleria')->get()->toArray());
        $medidas=Maestro::select('medida')->distinct('medida')->get()->toArray();
        foreach ($medidas as $medida){
            Medida::firstOrCreate($medida);
        }
        // Medida::insert(Maestro::select('medida')->distinct('medida')->get()->toArray());
        $mobiliarios=Maestro::select('mobiliario')->distinct('mobiliario')->get()->toArray();
        foreach ($mobiliarios as $mobiliario){
            Mobiliario::firstOrCreate($mobiliario);
        }
        // Mobiliario::insert(Maestro::select('mobiliario')->distinct('mobiliario')->get()->toArray());
        $propxelementos=Maestro::select('propxelemento')->distinct('propxelemento')->get()->toArray();
        foreach ($propxelementos as $propxelemento){
            Propxelemento::firstOrCreate($propxelemento);
        }
        // Propxelemento::insert(Maestro::select('propxelemento')->distinct('propxelemento')->get()->toArray());
        $segmentos=Maestro::select('segmento')->distinct('segmento')->get()->toArray();
        foreach ($segmentos as $segmento){
            Segmento::firstOrCreate($segmento);
        }
        // Segmento::insert(Maestro::select('segmento')->distinct('segmento')->get()->toArray());
        if($origen=="SGH"){
            $furnitures=Maestro::select('furniture_type')->distinct('furniture_type')->get()->toArray();
            foreach ($furnitures as $furniture){
                Furniture::firstOrCreate($furniture);
            }
            // Furniture::insert(Maestro::select('furniture_type')->distinct('furniture_type')->get()->toArray());
        }
        $storeconcepts=Maestro::select('storeconcept')->distinct('storeconcept')->get()->toArray();
        foreach ($storeconcepts as $storeconcept){
            Storeconcept::firstOrCreate($storeconcept);
        }
        // Storeconcept::insert(Maestro::select('storeconcept')->distinct('storeconcept')->get()->toArray());
        $materials=Maestro::select('material')->distinct('material')->get()->toArray();
        foreach ($materials as $material){
            Material::firstOrCreate($material);
        }
        // Material::insert(Maestro::select('material')->distinct('material')->get()->toArray());
        $tarifafamilias=Maestro::select('material','medida')
        ->groupBy('material','medida')
        ->get();
        foreach ($tarifafamilias as $tf){
            $mat=!is_null($tf->material)?$tf->material:'';
            $med=!is_null($tf->medida)?$tf->medida:'';
            $e=$mat . $med;
            $sust=array(" ","/","-","(",")","á","é","í",'ó','ú',"Á","É","Í",'Ó','Ú');
            $por=array("","","","","","a","e","i",'o','u',"A","E","I",'O','U');
            $e=str_replace($sust, $por, $e);
            $e=strtolower($e);
            TarifaFamilia::firstOrCreate(
                ['matmed'=>$e],
                ['material'=>$mat,
                'medida'=>$med]
            );
        }

        Maestro::insertStoresSGH();
        Maestro::insertElementosSGH();
        Maestro::insertStoreElementos(); 

        dd('finalizado');
        $notification = array(
            'message' => '¡Tablas principales actualizadas satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return view('home')->with($notification);
        
    }
}