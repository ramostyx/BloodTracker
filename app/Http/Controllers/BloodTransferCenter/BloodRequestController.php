<?php

namespace App\Http\Controllers\BloodTransferCenter;

use App\Events\FillBloodStockEvent;
use App\Events\SendPasswordEvent;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BloodDonation;
use App\Models\BloodRequest;
use App\Models\Client;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BloodRequestController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodRequest $bloodRequest)
    {
        $bloodRequest->delete();
        return back();
    }

    public function storeNew(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'country'=>['required', 'string', 'max:20'],
            'city'=>['required', 'string', 'max:20'],
            'zipCode'=>['required', 'string', 'max:20'],
            'province'=>['required', 'string', 'max:20'],
            'street'=>['required', 'string', 'max:20'],
            'quantity'=>['required', 'string', 'max:20'],
            'bloodType'=> ['required',Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);




        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' =>$request->phone,
//            'bloodType'=>$request->bloodType,
        ]);



        Address::create([
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'province' => $request->province,
            'zipCode' =>$request->zipCode,
            'addressable_id' => $client->id,
            'addressable_type' => 'App\Models\Client'
        ]);

        $stock=Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first();

        BloodRequest::create([
            'client_id'=>$client->id,
            'blood_stock_id'=>$stock->id,
            'quantity'=>$request->quantity,
            'bloodType' => $request->bloodType
        ]);
        if($stock->stock<$stock->threshold)
            event(new FillBloodStockEvent($stock));
        return back();
    }

    public function storeExisting(Request $request)
    {
        $request->validate([
            'bloodType' => ['required',Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'client_id' => 'required'
        ]);
        $client = Client::find($request->client_id);
//        $client->update(['bloodType'=>$request->bloodType]);
        $stock=Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first();
        BloodRequest::create([
            'client_id'=>$client->id,
            'blood_stock_id'=>$stock->id,
            'quantity'=>1,
            'bloodType' => $request->bloodType
        ]);
        if($stock->stock<$stock->threshold)
            event(new FillBloodStockEvent($stock));
        return back();
    }
}
