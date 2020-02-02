<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
{

    public function create()
    {
        $campo='area';
        $route='area.store';
        return view('auxiliares.createaux',compact('campo','route'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area'=>'required|unique:areas'
        ]);

        Area::create($request->all());

        $notification = array(
            'message' => 'Area creado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
    }

    public function edit($id)
    {
        $datos=Area::find($id);
        $campo='area';
        $route='area.update';
        return view('auxiliares.edit',compact('datos','campo','route'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'area'=>'required|unique:areas'
        ]);

        Area::where('id',$id)->update(['area'=>$request->area]);

        $notification = array(
            'message' => 'Area actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect('auxiliares')->with($notification);
    }

    public function destroy($id)
    {
        Area::destroy($id);

        $notification = array(
            'message' => 'Area eliminada satisfactoriamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
