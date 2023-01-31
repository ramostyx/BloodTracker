<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function like(Post $post){
        PostInteraction::updateOrCreate(
            ['post_id'=>$post->id,'user_id'=>Auth::user()->id],
            ['isLiked'=>true]
        );
        return response()->noContent();
    }
    public function unlike(Post $post){
        PostInteraction::updateOrCreate(
            ['post_id'=>$post->id,'user_id'=>Auth::user()->id],
            ['isLiked'=>false]
        );
        return response()->noContent();
    }
    public function save(Post $post){
        PostInteraction::updateOrCreate(
            ['post_id'=>$post->id,'user_id'=>Auth::user()->id],
            ['isSaved'=>true]
        );
        return response()->noContent();
    }
    public function unsave(Post $post){
        PostInteraction::updateOrCreate(
            ['post_id'=>$post->id,'user_id'=>Auth::user()->id],
            ['isSaved'=>false]
        );
        return response()->noContent();
    }
}
