<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodStock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bloodtransfercenter()
    {
        return $this->belongsTo(BloodTransferCenter::class,'blood_transfer_center_id');
    }

    public function donations()
    {
        return $this->belongsToMany(Donor::class,'blood_donations')->withPivot('quantity','created_at','id')->orderBy('created_at', 'desc');
    }

    public function requests()
    {
        return $this->belongsToMany(Client::class,'blood_requests')->withPivot('quantity','bloodType','created_at','id');
    }
}
