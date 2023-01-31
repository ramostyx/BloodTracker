<?php

namespace App\Http\Controllers\BloodTransferCenter;

use App\Http\Controllers\Controller;
use App\Models\BloodTransferCenter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

use App\Models\Address;
use Illuminate\Http\Request;

class BloodCenterController extends Controller
{
    //return view("listings.index", [
    //    'listings'=> listings::latest()->filter(request(['tag','search']))->get()
    //]);
    public function index()
    {
        //dd(request()->tag);
        //dd(listings::latest()->filter(request(['tag','search']))->get());
        $centers = User::all();
        return view("admin.admin", compact('centers'));

    }

    //Create single Center

    //public function Create(User $user){
    public function Create()
    {
        return view("admin.create-center");
    }

    public function store(Request $request)
    {
        // dd(1);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'country' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'zipCode' => ['required', 'string', 'max:20'],
            'province' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'center'
        ]);


        Address::create([
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'province' => $request->province,
            'zipCode' => $request->zipCode,
            'addressable_id' => $user->id,
            'addressable_type' => 'App\Models\User'
        ]);

        BloodTransferCenter::create(['user_id' => $user->id]);

        return redirect("/center")->with('message', 'centre created successfully');

    }

    //Delete single Center
    public function destroy(BloodTransferCenter $center_id)
    {

        $center_id->delete();
        return redirect('/admin')->with('message', 'center deleted succesfully');
    }


}
