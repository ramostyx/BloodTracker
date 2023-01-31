<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class,'donor_campaign');
    }
}
