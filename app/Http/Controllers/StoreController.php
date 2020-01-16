<?php

namespace App\Http\Controllers;

use App\{Area,Country,Segmento, Store, StoreElemento, Elemento, Furniture, Storeconcept};
use Illuminate\Support\Facades\DB;

use Image;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->busca) {
            $busqueda = $request->busca;
        } else {
            $busqueda = '';
        } 

        $stores=Store::search($request->busca)
        ->orderBy('id')
        ->paginate('10')->onEachSide(1);

        $countries=Country::get();
        $areas=Area::orderBy('area')->get();
        $segmentos=Segmento::orderBy('segmento')->get();
        $conceptos=Storeconcept::orderBy('storeconcept')->get();
        
        return view('stores.index',compact('stores','busqueda','countries','areas','segmentos','conceptos'));
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
        $request->validate([
            'id'=>'required|unique:stores',
            'name'=>'required',
            'country'=>'required',
            'area_id'=>'required',
            'segmento'=>'required',
            'concepto_id'=>'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:12288',
            ]);
            
            
        $a=Area::find($request->area_id)->area;
        $c=Storeconcept::find($request->concepto_id)->storeconcept;
        if($request->area=="Canarias")
        $z="CA";
        else
        $z=$request->country;

        $imagen="SGH.jpg";
        if(!is_null($request->imagen))
            $imagen = Store::subirImagen($request->id,$request->file('imagen'));
        
        DB::table('stores')->insert([
            'id'=>$request->id,
            'name'=>$request->name,
            'country'=>$request->country,
            'idioma'=>$request->idioma,
            'zona'=>$z,
            'area_id'=>$request->area_id,
            'area'=>$a,
            'segmento'=>$request->segmento,
            'concepto_id'=>$request->concepto_id,
            'concepto'=>$c,
            'imagen'=>$imagen,
            'observaciones'=>$request->observaciones,
             ]
        );

        $notification = array(
            'message' => 'Elemento creado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('store')->with($notification);
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
    public function edit(Store $store)
    {
        // $store = Store::find($id);

        $countries=Country::get();
        $areas=Area::orderBy('area')->get();
        $segmentos=Segmento::orderBy('segmento')->get();
        $conceptos=Storeconcept::orderBy('storeconcept')->get();
        $furnitures=Furniture::orderBy('furniture_type')->get();
        // dd($furnitures);

        return view('stores.edit', compact('store','countries','areas','segmentos','conceptos','furnitures'));
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
        
        $request->validate([
            'name'=>'required',
            'country'=>'required',
            'area_id'=>'required',
            'segmento'=>'required',
            'concepto_id'=>'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:12288',
            ]);

            
        $a=Area::find($request->area_id)->area;
        $c=Storeconcept::find($request->concepto_id)->storeconcept;
        if($request->area=="Canarias")
        $z="CA";
        else
        $z=$request->country;

        $imagen=$request->imagen;
        // dd($request->file('photo'));
        if($request->file('photo'))
            $imagen = Store::subirImagen($request->id,$request->file('photo'));

        DB::table('stores')->where('id',$id)->update([
            'name'=>$request->name,
            'country'=>$request->country,
            'idioma'=>$request->idioma,
            'zona'=>$z,
            'area_id'=>$request->area_id,
            'area'=>$a,
            'segmento'=>$request->segmento,
            'channel'=>$request->channel,
            'channel'=>$request->channel,
            'store_cluster'=>$request->store_cluster,
            'store_cluster'=>$request->store_cluster,
            'concepto_id'=>$request->concepto_id,
            'concepto'=>$c,
            'furniture_type'=>$request->furniture_type,
            'imagen'=>$imagen,
            'observaciones'=>$request->observaciones,
             ]
        );

        $notification = array(
            'message' => 'Elemento actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('store')->with($notification);

    }

    public function updateimagenindex(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:12288',
        ]);
            
        $store=Store::find($request->id);
        $store->imagen = Store::subirImagen($store->id,$request->file('imagen'));
        $store->save();

        return Response()->json($store);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {
        try{
            Store::destroy($id);;   
        }catch(\ErrorException $ex){
            return back()->withError($ex->getMessage());
        }
    
        // no funciona try catch!
    
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
    }
}

