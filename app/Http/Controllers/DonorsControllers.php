<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donor;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class DonorsControllers extends Controller
{
    //Create single Donor
    public function Create()
    {
        return view("admin.create-donor");
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phoneNumber' => ['required'],
            'country' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'zipCode' => ['required', 'string', 'max:20'],
            'province' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'bloodType' => ['required', 'string'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'role' => 'donor'
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

        Donor::create([
            'user_id' => $user->id,
            'bloodType' => $request->input('bloodType'),
        ]);

        return redirect("/admin")->with('message', 'centre created successfully');
    }

    //Delete single Center
    public function destroy(Donor $donor_id)
    {

        $donor_id->delete();
        return redirect('/admin')->with('message', 'donor deleted succesfully');
    }

}
