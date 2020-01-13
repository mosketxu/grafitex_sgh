<?php

namespace App\Http\Controllers;

use App\Furniture;
use Illuminate\Http\Request;

class FurnitureController extends Controller
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
        $campo='furniture_type';
        $route='furniture.store';
        return view('auxiliares.createaux',compact('campo','route'));
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
            'furniture_type'=>'required|unique:furnitures'
        ]);

        Furniture::create($request->all());

        $notification = array(
            'message' => 'Furniture Type creado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function show(Furniture $furniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos=Furniture::find($id);
        $campo='furniture_type';
        $route='furniture.update';
        return view('auxiliares.edit',compact('datos','campo','route'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'furniture_type'=>'required|unique:furnitures'
        ]);

        Furniture::where('id',$id)->update(['furniture_type'=>$request->furniture_type]);

        $notification = array(
            'message' => 'Furniture Type actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Furniture::destroy($id);

        $notification = array(
            'message' => 'Furniture Type eliminado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
