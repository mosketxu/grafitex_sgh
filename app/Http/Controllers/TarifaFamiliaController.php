<?php

namespace App\Http\Controllers;

use App\{Tarifa,TarifaFamilia};
use Illuminate\Http\Request;

class TarifaFamiliaController extends Controller
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
        $tarifafamilias = Tarifa::search($request->busca)
        ->where('tipo',0)
        ->paginate(25);
        
        $familias = Tarifa::where('tipo',0)
        ->orderBy('familia')
        ->get();


        $colors = array('primary','secondary','info','success', 'danger', 'warning',
            'black', 'gray', 'indigo', 'navy', 'purple', 'fuchsia',
            'pink', 'maroon', 'orange', 'lime', 'teal', 'olive');
        shuffle($colors);
        return view('tarifa.familia.index', compact('tarifafamilias','familias','busqueda','colors'));
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
            'material'=>'required',
            'medida'=>'required',
            'tarifa_id'=>'required',
        ]);

        $tarifafamilia = TarifaFamilia::create($request->all());

        $notification = array(
            'message' => 'Tarifa creada satisfactoriamente!',
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
    public function edit($id)
    {
        //
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
            'material' => 'required',
            'medida' => 'required',
            'tarifa_id' => 'required',
        ]);

        TarifaFamilia::find($id)->update($request->all());
        // dd(TarifaFamilia::find($id));

        $notification = array(
            'message' => 'Tarifa actualizada satisfactoriamente!',
            'alert-type' => 'success'
        );

        // return response()->json([
        //     "mensaje" => $request->all(),
        //     'notification'=> '¡Línea actualizada satisfactoriamente!',
        //     ]);
        return redirect()->back()->with($notification);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TarifaFamilia::find($id)->delete();

        $notification = array(
            'message' => 'Tarifa eliminada satisfactoriamente!',
            'alert-type' => 'success' 
        );
  
        return redirect()->back()->with($notification);

    }
}
