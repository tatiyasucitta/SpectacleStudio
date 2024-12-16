<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Category extends Model
{

    protected $fillable = ['name', 'image'];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
