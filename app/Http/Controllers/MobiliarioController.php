<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobiliario;

class MobiliarioController extends Controller
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
        $campo='mobiliario';
        $route='mobiliario.store';
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
            'mobiliario'=>'required|unique:mobiliarios'
        ]);

        Mobiliario::create($request->all());

        $notification = array(
            'message' => 'Mobiliario creado satisfactoriamente!',
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
        $datos=Mobiliario::find($id);
        $campo='mobiliario';
        $route='mobiliario.update';
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
            'mobiliario'=>'required|unique:mobiliarios'
        ]);

        Mobiliario::where('id',$id)->update(['mobiliario'=>$request->mobiliario]);

        $notification = array(
            'message' => 'Mobiliario actualizado satisfactoriamente!',
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
        Mobiliario::destroy($id);

        $notification = array(
            'message' => 'Mobiliario eliminada satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
