<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $centers=User::all();
        $donors=$centers;
            return view("admin.admin", compact('centers','donors'));

    }

    //Delete single Center
    public function destroy(User $center_id){
       // dd($center_id);

        $center_id->delete();

        if($center_id->hasRole('center')){
            $center_id->bloodtransfercenter()->delete();
            return redirect('/admin')->with('message','center deleted succesfully');
        }
        
        return redirect('/admin')->with('message','donor deleted succesfully');
    }
}
