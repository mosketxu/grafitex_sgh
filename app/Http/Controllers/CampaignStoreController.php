<?php

namespace App\Http\Controllers;

use App\{CampaignStore, Store};
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CampaignStoreController extends Controller
{


    public function stoAsoc($campaignid)
    {
        // $stoAsoc=CampaignStore::where('campaign_id',$campaignid)->get();

        $stoAsoc = CampaignStore::join('stores', 'stores.id', "=", "store_id")
            ->select('campaign_stores.id as campStoId', 'stores.id', 'stores.store')
            ->where('campaign_id', $campaignid)->get();

        return response()->json(
            $stoAsoc->toArray()
        );
    }

    public function stoDisp($campaignid)
    {

        $stoDisp = Store::whereNotIn('id', function ($query) use ($campaignid) {
            $query->select('store_id')->from('campaign_stores')->where('campaign_id', '=', $campaignid);
        })->get();

        return response()->json(
            $stoDisp->toArray()
        );
    }


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
        $camStoId = DB::table('campaign_stores')->insertGetId([
            'campaign_id' => $request->campaignId,
            'store_id' =>  $request->storeId
        ]);

        $store = DB::table('stores')
            ->where('id', $request->storeId)
            ->first();

        return response()->json([
            'campaignstoreId' => $camStoId,
            'campaignId' => $request->campaignId,
            'store' => $store,

        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // $empresa = UserEmpresa::findOrFail($request->userEmpId);
            $sto =  DB::table('stores')
                ->where('id', $request->stoId)
                ->first();

            // $empresa = UserEmpresa::where('empresa_id', $request->empresa_id)->where('user_id', $request->user_id)->delete();
            $store = DB::table('campaign_stores')
                ->where('campaign_id', $request->campId)
                ->where('store_id', $request->stoId)
                ->delete();

            $a = Store::first()->store;

            return response()->json(
                [
                    'storename' => $sto->store,
                    'campId' => $request->campId,
                    'campStoId' => $request->campstoId,
                ]
            );
        }
    }
}
