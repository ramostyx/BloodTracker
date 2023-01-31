<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodTransferCenter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bloodstocks()
    {
        return $this->hasMany(BloodStock::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function transactions()
    {

        return $this->bloodstocks->flatMap(function ($stock) {
            $requests = $stock->requests->map(function ($request) {
                return (object) [
                    'bloodType' => $request->pivot->bloodType,
                    'quantity' => $request->pivot->quantity,
                    'date' => $request->pivot->created_at,
                    'operation' => '-',
                ];
            });
            $donations = $stock->donations->map(function ($donation) {
                return (object) [
                    'bloodType' => $donation->bloodType,
                    'quantity' => $donation->pivot->quantity,
                    'date' => $donation->pivot->created_at,
                    'operation' => '+',
                ];
            });

            if ($requests->isEmpty() && $donations->isEmpty()) {
                return collect();
            }
            if ($requests->isEmpty()) {
                return $donations;
            }
            if ($donations->isEmpty()) {
                return $requests;
            }
            return $requests->merge($donations);
        })->sortByDesc('date');

    }

    public function stockLevels()
    {
        $bloodTypes = ['A','B','AB','O'];
        $bloodTypeCollection = collect();
        foreach ($bloodTypes as $bloodType) {
            $positiveStock = $this->bloodstocks
                ->where('bloodType', $bloodType.'+')
                ->first();
            $negativeStock = $this->bloodstocks
                ->where('bloodType', $bloodType.'-')
                ->first();
            $bloodTypeData =(object) [
                'bloodType' => $bloodType,
                'positive' => [
                    'stock' => $positiveStock ? $positiveStock->stock : 0,
                    'capacity' => $positiveStock ? $positiveStock->capacity : 0,
                ],
                'negative' => [
                    'stock' => $negativeStock ? $negativeStock->stock : 0,
                    'capacity' => $negativeStock ? $negativeStock->capacity : 0,
                ]
            ];
            $bloodTypeCollection->push($bloodTypeData);
        }
        return $bloodTypeCollection;
    }

    public function donationsCount()
    {
        return $this->bloodstocks->map(function ($stock) {
            return $stock->donations->count();
        })->sum();
    }

}
