<?php

namespace App\Http\Controllers;

use App\{Store,Elemento, StoreElemento,Ubicacion,Mobiliario,Propxelemento,Carteleria,Medida,Material};
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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

        $ubicacion=$request->get('ubicacion');
        $mobiliario=$request->get('mobiliario');
        $carteleria=$request->get('carteleria');
        $material=$request->get('material');
        $propxelemento=$request->get('propxelemento');

        
        $store=Store::find($storeId);
        $mob= $request->mobiliario_id ? $request->mobiliario_id : '';

        $elementosDisp = Elemento::whereNotIn('id', function ($query) use ($storeId) {
            $query->select('elemento_id')->from('store_elementos')->where('store_id', '=', $storeId);
        })
        ->ubicacion($ubicacion)
        ->mobiliario($mobiliario)
        ->carteleria($carteleria)
        ->material($material)
        ->propxelemento($propxelemento)
        ->paginate(10)
        ->onEachSide(1);

        // dd($totalelementosDisp);

        $propxelementoes=Ubicacion::orderBy('ubicacion')->get();
        $mobiliarios=Mobiliario::orderBy('mobiliario')->get();
        $propxelementos=Propxelemento::orderBy('propxelemento')->get();
        $cartelerias=Carteleria::orderBy('carteleria')->get();
        $medidas=Medida::orderBy('medida')->get();
        $materiales=Material::orderBy('material')->get();
        return view('stores.storeelementos.edit',compact('store','elementosDisp','busqueda',
            'ubicaciones','mobiliarios','propxelementos','cartelerias','medidas','familias','materiales'));
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
        //
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
