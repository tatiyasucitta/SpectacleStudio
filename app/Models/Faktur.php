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
    ];

    public function Cart(){
        return $this->hasMany(Cart::class,'faktur_id');
    }
}
