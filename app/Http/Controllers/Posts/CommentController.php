<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => ['required', 'string']
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'body' => $request->comment,
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Models\Post'
        ]);
        return back();
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'reply' => ['required', 'string']
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'body' => $request->reply,
            'commentable_id' => $comment->id,
            'commentable_type' => 'App\Models\Comment'
        ]);
        return back();

    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }

}
