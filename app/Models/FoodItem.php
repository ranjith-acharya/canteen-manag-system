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
        'price',
        'description',
        'canteen_id',
    ];

    public function canteen(){
        return $this->belongsToMany('App\Models\Canteen');
    }

    public function order(){
        return $this->hasOne('App\Models\Order');
    }
}
