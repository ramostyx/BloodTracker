<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requests()
    {
        return $this->belongsToMany(BloodStock::class,'blood_transactions')->withPivot('quantity','bloodType','created_at','id')->orderBy('created_at', 'desc');
    }
    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }
}
