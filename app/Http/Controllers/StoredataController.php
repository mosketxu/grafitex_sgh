<?php

namespace App\Http\Controllers;

use App\Storedata;
use Illuminate\Http\Request;
use App\Imports\StoredataImport;
use App\Store;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class StoredataController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        if(request()->file('maestro')){
            DB::table('storedatas')->delete();
            Excel::import(new StoredataImport,request()->file('maestro'));
        }

        $storedatas=Storedata::get();
        foreach ($storedatas as $storedata) {
            $store=Store::find($storedata->id);
            if(!is_null($store)){
                Store::where('id',$storedata->id)
                    ->update([
                       'luxotica'=>$storedata->luxotica,
                       'address'=>$storedata->address,
                       'city'=>$storedata->city,
                       'province'=>$storedata->province,
                       'cp'=>$storedata->cp,
                       'phone'=>$storedata->phone,
                       'email'=>$storedata->email,
                       'winterschedule'=>$storedata->winterschedule,
                       'summerschedule'=>$storedata->summerschedule,
                       'deliverytime'=>$storedata->deliverytime,
                       'observaciones'=>$storedata->observaciones
                    ]
                );
            }
        };
        $notification = array(
            'message' => '¡Tiendas actualizadas satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return redirect('/store/index')->with($notification);
    }
}