<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function donations()
    {
        return $this->belongsToMany(BloodStock::class,'blood_donations')->withPivot('quantity','created_at','id')->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class,'donor_campaign');
    }
}
