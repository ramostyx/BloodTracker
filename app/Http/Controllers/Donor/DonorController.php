<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\PostInteraction;

class DonorController extends Controller
{
    public function history()
    {
        $donations = auth()->user()->donor->donations;
        return view('donors.history',compact('donations'));
    }
//    public function savedPosts()
//    {
//        $posts = PostInteraction::where('user_id',auth()->user()->id)->where('isSaved',true);
//        return view('donors.savedPosts',compact('posts'));
//    }
}
