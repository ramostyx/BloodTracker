<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests= \App\Models\Request::all();
        return view('posts.Requests.index',compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.Requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'requiredBlood' => ['required'],
            'urgency' => ['required', 'string', 'max:255'],

        ]);


        $post=Post::create([
            'blood_transfer_center_id' =>Auth::user()->bloodtransfercenter->id,
            'title'=>$request->title,
            'body'=>$request->description,
        ]);
        \App\Models\Request::create([
            'post_id'=>$post->id,
            'requiredBloodTypes'=>$request->requiredBlood,
            'urgency'=>$request->urgency,
        ]);

        return Redirect::route('requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Request $request)
    {
        return view('posts.Requests.show',compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Request $request)
    {

        return view('posts.Requests.edit',compact('request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, \App\Models\Request $request)
    {
        $req->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'requiredBlood' => ['required'],
            'urgency' => ['required', 'string', 'max:255'],

        ]);


        $request->post->update([
            'title'=>$req->title,
            'body'=>$req->description,
        ]);
        $request->update([
            'requiredBloodTypes'=>$req->requiredBlood,
            'urgency'=>$req->urgency,
        ]);

        return Redirect::route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Request $request)
    {
        $request->delete();
        return back();
    }
}
