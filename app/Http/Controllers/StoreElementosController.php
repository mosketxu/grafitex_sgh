<?php

namespace App\Http\Controllers;

use App\{Store,Elemento, StoreElemento,Ubicacion,Mobiliario,Propxelemento,Carteleria,Medida,Material};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Element;

class StoreElementosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($storeId, Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $store=Store::find($storeId);
        $storeelementos=StoreElemento::search($request->busca)
        ->join('elementos','store_elementos.elemento_id','elementos.id')
        ->where('store_id',$storeId)
        ->paginate('10')->onEachSide(1);

        return view('stores.storeelementos.index',compact('store','busqueda','storeelementos','totalElementos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$store_id)
    {
        $request->validate([
            'elemento_id'=>'required'
        ]);

        $elementificador=Elemento::find($request->elemento_id)->elementificador;

        DB::table('store_elementos')
            ->insert([
            'store_id'=>$store_id,
            'elemento_id'=>$request->elemento_id,
            'elementificador'=>$elementificador,
            ]);

        $notification = array(
            'message' => 'Elemento añadido satisfactoriamente a la store!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($storeId, Request $request)
    {
        
        $store=Store::find($storeId);

        $ubi=$request->get('ubi');
        $mob=$request->get('mob');
        $cart=$request->get('cart');
        $mat=$request->get('mat');
        $med=$request->get('med');
        $propx=$request->get('propx');

        $elementosDisp = Elemento::whereNotIn('id', function ($query) use ($storeId) {
            $query->select('elemento_id')->from('store_elementos')->where('store_id', '=', $storeId);
            })
        ->ubi($request->ubi)
        ->mob($request->mob)
        ->cart($request->cart)
        ->mat($request->mat)
        ->med($request->med)
        ->propx($request->propx)
        ->paginate(10)
        ->onEachSide(1);

        // dd($totalelementosDisp);

        return view('stores.storeelementos.edit',compact('store','elementosDisp',
            'ubi','mob','propx','cart','med','mat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        try{
            StoreElemento::destroy($id);;   
        }catch(\ErrorException $ex){
            return back()->withError($ex->getMessage());
        }

        // no funcionan los mensajes ni try catch!

        $notification = array(
            'message' => 'Elemento eliminado satisfactoriamente!',
            'alert-type' => 'success'
        );

        if($request->ajax()){
            return response()->json([
                'id'=>$id,
                'notificacion'=>$notification,
            ]);
        }
        return redirect()->back()->with($notification);

    }
}
