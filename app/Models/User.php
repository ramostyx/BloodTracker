<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//implements MustVerifyEmail

class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phoneNumber',
        'profileImage'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role): bool
    {
        return $this->role == $role;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function donor()
    {
        return $this->hasOne(Donor::class);
    }

    public function bloodtransfercenter()
    {
        return $this->hasOne(BloodTransferCenter::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }

    public function Owner($id): bool
    {
        return $this->id==$id;
    }

    public function likeCount()
    {
        return PostInteraction::where('user_id',$this->id)->where('isLiked',true)->count();
    }
    public function saveCount()
    {
        return PostInteraction::where('user_id',$this->id)->where('isSaved',true)->count();

    }

    public function scopeFilter($query,array $filters){

        if($filters['search'] ?? false ){
         //dd($query);
            $query->where('name','like','%' . request('search') . '%');
        }

     }
}
