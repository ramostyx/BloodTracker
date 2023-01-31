<?php

namespace App\Http\Controllers\BloodTransferCenter;

use App\Events\FullBloodStockEvent;
use App\Events\SendPasswordEvent;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BloodDonation;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BloodDonationController extends Controller
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
     * @param  \App\Models\BloodDonation  $bloodDonation
     * @return \Illuminate\Http\Response
     */
    public function show(BloodDonation $bloodDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodDonation  $bloodDonation
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodDonation $bloodDonation)
    {
        return view('BloodTransferCenters.donations.edit',compact('bloodDonation'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BloodDonation  $bloodDonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodDonation $bloodDonation)
    {
        $bloodDonation->update([
            'blood_stock_id'=>Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first()->id,
            'quantity'=>1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodDonation  $bloodDonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodDonation $bloodDonation)
    {
        $bloodDonation->delete();
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
            'bloodType'=> ['required',Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);

        $password=Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>$request->phone,
            'password' => Hash::make($password),
        ]);



        Address::create([
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'province' => $request->province,
            'zipCode' =>$request->zipCode,
            'addressable_id' => $user->id,
            'addressable_type' => 'App\Models\User'
        ]);

        $donor=Donor::create([
            'user_id'=>$user->id,
            'bloodType'=>$request->bloodType,
        ]);
        $stock=Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first();
        BloodDonation::create([
            'donor_id'=>$donor->id,
            'blood_stock_id'=>$stock->id,
            'quantity'=>1,
        ]);
        if($stock->stock>$stock->threshold)
            event(new FullBloodStockEvent($stock));
        event(new SendPasswordEvent($user->email, $password));
        return back();
    }

    public function storeExisting(Request $request)
    {
        $request->validate([
            'bloodType' => ['required',Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'donor_id' => 'required'
        ]);
        $donor = Donor::find($request->donor_id);
        $donor->update(['bloodType'=>$request->bloodType]);
        $stock=Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first();
        BloodDonation::create([
            'donor_id'=>$donor->id,
            'blood_stock_id'=>Auth::user()->bloodtransfercenter->bloodstocks->where('bloodType',$request->bloodType)->first()->id,
            'quantity'=>1,
        ]);
        if($stock->stock>$stock->threshold)
            event(new FullBloodStockEvent($stock));
        return back();
    }
}
