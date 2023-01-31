<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'requiredBloodTypes' => 'array'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function progress()
    {
        $stocks=collect();
        foreach ($this->requiredBloodTypes as $type)
        {
            $stocks->push(
            $this->post->bloodtransfercenter->bloodstocks
                ->where('bloodType',$type));
        }
        $stocks=$stocks->flatten();
        $sum=$stocks->map(function ($stock) {
            return number_format(($stock->stock/$stock->threshold) * 100,2);
        })->sum();

        return$sum/$stocks->count();

    }
}
