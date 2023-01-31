<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function request()
    {
        return $this->hasOne(Request::class);
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function bloodtransfercenter()
    {
        return $this->belongsTo(BloodTransferCenter::class,'blood_transfer_center_id');
    }
    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }

    public function liked(): bool
    {
        if (Auth::user()){
            $isliked = PostInteraction::where('post_id', $this->id)
                ->where('user_id', Auth::user()->id)->first();
        return $isliked && $isliked->isLiked;
        }
        return false;
    }
    public function bookmarked(): bool
    {
        if(Auth::user()){
            $issaved=PostInteraction::where('post_id',$this->id)
                ->where('user_id',Auth::user()->id)->first();
            return $issaved && $issaved->isSaved;
        }
        return false;

    }

    public function likeCount()
    {
        return PostInteraction::where('post_id',$this->id)->where('isLiked',true)->count();
    }
    public function saveCount()
    {
        return PostInteraction::where('post_id',$this->id)->where('isSaved',true)->count();

    }

}
