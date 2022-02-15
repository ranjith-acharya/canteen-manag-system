<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'avatar',
        'branch',
        'year',
        'department',
        'contact',
        'instagram',
        'linkedin',
        'customer_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
