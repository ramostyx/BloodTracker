<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Donor;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);




        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>$request->phone,
            'password' => Hash::make($request->password),
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

        Donor::create(['user_id'=>$user->id]);



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
