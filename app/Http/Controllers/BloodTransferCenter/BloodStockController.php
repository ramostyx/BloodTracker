<?php

namespace App\Http\Controllers\BloodTransferCenter;

use App\Http\Controllers\Controller;
use App\Models\BloodTransferCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloodStockController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodTransferCenter  $bloodTransferCenter
     * @return \Illuminate\Http\Response
     */
    public function show(BloodTransferCenter $bloodTransferCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodTransferCenter  $bloodTransferCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodTransferCenter $bloodTransferCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BloodTransferCenter  $bloodTransferCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodTransferCenter $bloodTransferCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodTransferCenter  $bloodTransferCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodTransferCenter $bloodTransferCenter)
    {
        //
    }

    public function bloodStock()
    {
        $transactions = Auth::user()->bloodtransfercenter->transactions();
        $stocks = Auth::user()->bloodtransfercenter->bloodstocks;
        $levels = Auth::user()->bloodtransfercenter->stockLevels();
        return view('BloodTransferCenters/bloodStock',compact('stocks','transactions','levels'));
    }
}
