<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'price',
        'type',
        'count',
        'total',
        'reference',
        'customer_id',
        'canteen_id',
    ];

    public function food(){
        return $this->belongsTo('App\Models\FoodItem');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function canteen(){
        return $this->belongsTo('App\Models\Canteen');
    }
}
