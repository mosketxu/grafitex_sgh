<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Segmento;

class SegmentoController extends Controller
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
        $campo='segmento';
        $route='segmento.store';
        return view('auxiliares.create',compact('campo','route'));
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
            'segmento'=>'required|unique:segmentos'
        ]);

        Segmento::create($request->all());

        $notification = array(
            'message' => 'Segmento creado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
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
        $datos=Segmento::find($id);
        $campo='segmento';
        $route='segmento.update';
        return view('auxiliares.edit',compact('datos','campo','route'));

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
            'segmento'=>'required|unique:segmentos'
        ]);

        Segmento::where('id',$id)->update(['segmento'=>$request->segmento]);

        $notification = array(
            'message' => 'Segmento actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Segmento::destroy($id);

        $notification = array(
            'message' => 'Segmento eliminada satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
