<?php

namespace App\Http\Controllers;

use App\{Elemento,Ubicacion,Mobiliario,Propxelemento,Carteleria,Medida,Material, Tarifa};
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElementoController extends Controller
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
        
        $elementos=Elemento::search($request->busca)
        ->paginate()->onEachSide(1);

        $ubicaciones=Ubicacion::orderBy('ubicacion')->get();
        $mobiliarios=Mobiliario::orderBy('mobiliario')->get();
        $propxelementos=Propxelemento::orderBy('propxelemento')->get();
        $cartelerias=Carteleria::orderBy('carteleria')->get();
        $medidas=Medida::orderBy('medida')->get();
        $familias=Tarifa::orderBy('familia')->get();
        $materiales=Material::orderBy('material')->get();
        return view('elementos.index',compact('elementos','busqueda',
            'ubicaciones','mobiliarios','propxelementos','cartelerias','medidas','familias','materiales'));
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
            'ubicacion_id'=>'required',
            'mobiliario_id'=>'required',
            'propxelemento_id'=>'required',
            'carteleria_id'=>'required',
            'medida_id'=>'required',
            'material_id'=>'required',
            'familia_id'=>'required',
            'unitxprop'=>'required|numeric',
         ]);

         $u=Ubicacion::find($request->ubicacion_id)->ubicacion;
         $m=Mobiliario::find($request->mobiliario_id)->mobiliario;
         $p=Propxelemento::find($request->propxelemento_id)->propxelemento;
         $c=Carteleria::find($request->carteleria_id)->carteleria;
         $me=Medida::find($request->medida_id)->medida;
         $ma=Material::find($request->material_id)->material;
         $uxp=$request->unitxprop;
         $e= str_replace(" ","",$u.$m.$c.$me.$ma.$uxp);
        $controlElementificador=Elemento::where('elementificador',$e)->count();

        if ($controlElementificador>0){
            $notification = array(
                'message' => 'Este Elemento ya existe.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($notification);
        }

       
         DB::table('elementos')->insert([
            'elementificador'=>$e,
            'ubicacion_id'=>$request->ubicacion_id,
            'ubicacion'=>$u,
            'mobiliario_id'=>$request->mobiliario_id,
            'mobiliario'=>$m,
            'propxelemento_id'=>$request->propxelemento_id,
            'propxelemento'=>$p,
            'carteleria_id'=>$request->carteleria_id,
            'carteleria'=>$c,
            'medida_id'=>$request->medida_id,
            'medida'=>$me,
            'material_id'=>$request->material_id,
            'material'=>$ma,
            'unitxprop'=>$request->unitxprop,
            'observaciones'=>$request->observaciones,
             ]
        );

        $notification = array(
            'message' => 'Elemento creado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('elemento')->with($notification);

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
    public function edit($id)
    {

        $elemento=Elemento::find($id);
        $ubicaciones=Ubicacion::orderBy('ubicacion')->get();
        $mobiliarios=Mobiliario::orderBy('mobiliario')->get();
        $propxelementos=Propxelemento::orderBy('propxelemento')->get();
        $cartelerias=Carteleria::orderBy('carteleria')->get();
        $medidas=Medida::orderBy('medida')->get();
        $familias=Tarifa::orderBy('familia')->get();
        $materiales=Material::orderBy('material')->get();

        return view('elementos.edit',compact('elemento','ubicaciones','mobiliarios','propxelementos','cartelerias','medidas','familias','materiales'));

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
        // dd($request);

        $request->validate([
            'ubicacion_id'=>'required',
            'mobiliario_id'=>'required',
            'propxelemento_id'=>'required',
            'carteleria_id'=>'required',
            'medida_id'=>'required',
            'material_id'=>'required',
            'familia_id'=>'required',
            'unitxprop'=>'required|numeric',
         ]);

         $u=Ubicacion::find($request->ubicacion_id)->ubicacion;
         $m=Mobiliario::find($request->mobiliario_id)->mobiliario;
         $p=Propxelemento::find($request->propxelemento_id)->propxelemento;
         $c=Carteleria::find($request->carteleria_id)->carteleria;
         $me=Medida::find($request->medida_id)->medida;
         $ma=Material::find($request->material_id)->material;
         $uxp=$request->unitxprop;
         $e= str_replace(" ","",$u.$m.$c.$me.$ma.$uxp);
        $controlElementificador=Elemento::where('elementificador',$e)->count();

        if ($controlElementificador>0){
            $notification = array(
                'message' => 'Este Elemento ya existe.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($notification);
        }

       
         DB::table('elementos')
         ->where('id',$id)
         ->update([
            'elementificador'=>$e,
            'ubicacion_id'=>$request->ubicacion_id,
            'ubicacion'=>$u,
            'mobiliario_id'=>$request->mobiliario_id,
            'mobiliario'=>$m,
            'propxelemento_id'=>$request->propxelemento_id,
            'propxelemento'=>$p,
            'carteleria_id'=>$request->carteleria_id,
            'carteleria'=>$c,
            'medida_id'=>$request->medida_id,
            'medida'=>$me,
            'material_id'=>$request->material_id,
            'material'=>$ma,
            'unitxprop'=>$request->unitxprop,
            'observaciones'=>$request->observaciones,
             ]
        );

        $notification = array(
            'message' => 'Elemento Actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('elemento')->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        // try{
            Elemento::destroy($id);;   
        // }catch(\ErrorException $ex){
        //     return back()->withError($ex->getMessage());
        // }

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
        // Session::flash('message',$this->elemento->id, 'ha sido eliminado');
        // return redirect()->back()
        // $request->session()->flash('key', $value);
    }
}
