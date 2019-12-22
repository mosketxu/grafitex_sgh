<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::orderBy('name')->paginate();
        
        return view('permisos.index',compact('permissions'));
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
            'name'=>'required|unique:permissions,name',
            'slug'=>'required|unique:permissions,slug',
            ]);

        Permission::insert($request->except('_token'));

        $notification = array(
            'message' => 'Permiso creado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('permisos')->with($notification);
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
    public function edit(Permission $permission)
    {
        return view('permisos.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $data = request()->validate([
            'name' => ['required',Rule::unique('permissions')->ignore($permission->id)],
            'slug' => ['required',Rule::unique('permissions')->ignore($permission->id)],
            ]);
            
        $permission->update($request->all());
            
        $notification = array(
            'message' => 'Permiso actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('permisos')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Permission::destroy($id);;   
        }catch(\ErrorException $ex){
            return back()->withError($ex->getMessage());
        } 
   
        $notification = array(
            'message' => 'Permiso eliminado satisfactoriamente!',
            'alert-type' => 'success'
        );
    
        return response()->json([
            'id'=>$id,
            'notificacion'=>$notification,
        ]);
    }
}
