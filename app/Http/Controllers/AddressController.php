<?php

namespace App\Http\Controllers;

use App\{Address, Store};
use Illuminate\Http\Request;

class AddressController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $addresses = Address::create($request->all());

        $cont = 0;

        return redirect()->route('store.index');
    }

}
