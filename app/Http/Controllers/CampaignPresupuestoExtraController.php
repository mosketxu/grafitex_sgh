<?php

namespace App\Http\Controllers;

use App\{CampaignPresupuesto,CampaignPresupuestoExtra,CampaignPresupuestoDetalle};
use Illuminate\Http\Request;

class CampaignPresupuestoExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'concepto' => 'required',
            'zona' => 'required',
            'unidades' => 'required|numeric',
            'preciounidad' => 'required|numeric',
            ]);

        $extra = new CampaignPresupuestoExtra;

        $extra->presupuesto_id = $request->presupuesto_id;
        $extra->concepto = $request->concepto;
        $extra->zona = $request->zona;
        $extra->preciounidad = $request->preciounidad;
        $extra->unidades = $request->unidades;
        $extra->total = $request->total;
        $extra->observaciones = $request->observaciones;

        $extra->save();


        $totalExtras = CampaignPresupuestoExtra::where('presupuesto_id',$request->presupuesto_id)
            ->sum('total');
        $totalMateriales=CampaignPresupuestoDetalle::where('presupuesto_id',$request->presupuesto_id)
            ->sum('total');
            
        $campPresu=CampaignPresupuesto::where('id',$request->presupuesto_id)
            ->first();
        $campPresu->total=$totalExtras+$totalMateriales;
            $campPresu->save();


        // return response()->json([
        //     "mensaje" => $request->all(),
        //     'notification'=> '¡Línea añadida satisfactoriamente!',
        //     ]);

        $notification = array(
            'message' => '¡Concepto añadido satisfactoriamente!',
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
        $request->preciounidad=str_replace(',', '.', $request->preciounidad);
        
        $request->validate([
            'zona' => 'required',
            'unidades' => 'required|numeric',
            'preciounidad' => 'required',
            ]);

        if(!is_numeric($request->preciounidad))
            $request->validate(['preciounidad' => 'required|numeric']);
            
        $presupExtra = CampaignPresupuestoExtra::find($id);
            $presupExtra->unidades = $request->unidades;
            $presupExtra->preciounidad = $request->preciounidad;
            $presupExtra->total = $request->total;
            $presupExtra->observaciones = $request->observaciones;
        $presupExtra->save();
            
        $totalExtras = CampaignPresupuestoExtra::where('presupuesto_id',$request->presupuesto_id)
            ->sum('total');

        $totalMateriales=CampaignPresupuestoDetalle::where('presupuesto_id',$request->presupuesto_id)
            ->sum('total');
            
           
        $campPresu=CampaignPresupuesto::where('id',$request->presupuesto_id)
            ->first();


        $campPresu->total=$totalExtras+$totalMateriales;
        $campPresu->save();


        // $notification = array(
        //     'message' => 'Línea actualizada satisfactoriamente!',
        //     'alert-type' => 'success'
        // );
            
        // return redirect()->back()->with($notification);

        return response()->json([
            "mensaje" => $request->all(),
            "totExtra"=>$totalExtras,
            "tot"=>$totalExtras+$totalMateriales,
            'notification'=> '¡Línea actualizada satisfactoriamente!',
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CampaignPresupuestoExtra::find($id)->delete();

        $notification = array(
            'message' => '¡Concepto eliminado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
