<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $fillable = [
        'invoice',
        'name',
        'phone',
        'address',
        'user_id'
    ];

    public function Cart(){
        return $this->hasMany(Cart::class,'faktur_id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
