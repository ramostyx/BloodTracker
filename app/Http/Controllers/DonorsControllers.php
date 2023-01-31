<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donor;
use App\Models\Address;
use Illuminate\Validation\Rule;

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
            'name' => 'required',
            'phoneNumber' => 'required|numeric|digits:10',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
            'email' => ['required', 'email', Rule::unique('Users', 'email')],
            'street' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'province' => 'required|string|max:255',
            'zipCode' => 'required|numeric|digits:5',
            'bloodType' => 'required|string',

        ]);

        $address = new Address([
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'zipCode' => $request->input('zipCode'),
            'country' => $request->input('country'),
            // Other address data
        ]);


        $pass = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'password' => $pass,
            'email' => $request->email,
            'role' => 'donor'
        ]);
        $user->address()->save($address);

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
        $donor_id->user->delete();
        return redirect('/admin')->with('message', 'donor deleted succesfully');
    }

}
