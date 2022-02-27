<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Canteen extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'status',
    ];

    public function food(){
        return $this->hasMany('\App\Models\FoodItem', 'canteen_id');
    }

    public function order(){
        return $this->hasMany('App\Models\Order', 'canteen_id');
    }

    public function profile(){
        return $this->hasOne('App\Models\Profile', 'customer_id');
    }
}
