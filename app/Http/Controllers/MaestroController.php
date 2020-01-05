<?php

namespace App\Http\Controllers;

use App\Imports\MaestrosImport;
use App\{Maestro,Ubicacion,Area, Carteleria, Country, Material, Medida, Mobiliario, Segmento, Storeconcept,Propxelemento};
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
        $conce=$request->get('conce');
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

        return view('maestro.index',compact('maestros','sto','nam','coun','are','seg','conce','ubi','mob','cart','mat','med','propx'));
    }

  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        dd('finalizado');
        // $notification = array(
        //     'message' => '¡Tablas principales actualizadas satisfactoriamente!',
        //     'alert-type' => 'success'
        // );
        
        // return view('home')->with($notification);
        
    }
}