<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'invoice_id',
        'faktur_id'];

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function faktur(){
        return $this->belongsTo(Faktur::class,'faktur_id');
    }
}
