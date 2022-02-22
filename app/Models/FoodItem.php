<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FoodItem extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'type',
        'image',
        'half_price',
        'full_price',
        'canteen_id',
    ];

    public function canteen(){
        return $this->belongsToMany('App\Models\Canteen');
    }
}
