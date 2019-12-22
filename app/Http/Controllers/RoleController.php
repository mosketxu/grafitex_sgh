<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::orderBy('name')->paginate();
        
        return view('roles.index',compact('roles'));
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
            'name'=>'required|unique:roles,name',
            ]);

            // dd($request->description);
        Role::insert([
            'name'=>$request->name,
            'description'=>$request->description,
            'special'=>$request->special,
            'slug'=>str_replace(' ','-',$request->name),
             ]
        );

        $notification = array(
            'message' => 'Rol creado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('roles')->with($notification);

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
    public function edit(Role $role)
    {
        $permissions=Permission::orderBy('name')->get();

        return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = request()->validate([
            'name' => ['required',Rule::unique('roles')->ignore($role->id)],
            ]);
            
            $role->update($data);
            $role->permissions()->sync($request->get('permissions'));
            
        $notification = array(
            'message' => 'Role actualizado satisfactoriamente!',
            'alert-type' => 'success'
        );
        return redirect('roles')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('llego');
        try{
            Role::destroy($id);;   
        }catch(\ErrorException $ex){
            return back()->withError($ex->getMessage());
        } 
   
        $notification = array(
            'message' => 'Rol eliminado satisfactoriamente!',
            'alert-type' => 'success'
        );
    
        return response()->json([
            'id'=>$id,
            'notificacion'=>$notification,
        ]);
    }
}
